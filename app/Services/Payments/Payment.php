<?php

namespace App\Services\Payments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class Payment implements iPayment
{
    private $client;

    /**
     * Payment constructor.
     */
    public function __construct()
    {
        $this->client=new Client(['headers' => [
            'Content-Type' => 'application/json',
        ]]);
    }

    /*
     * Returns Oauth token received from PayU API
     */
    protected function getToken(): String
    {
        try {
            $response = $this->client->request('POST',config('payment.payU.oauth_endpoint'), [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('payment.payU.client_id'),
                    'client_secret' => config('payment.payU.client_secret'),
                ]
            ]);
        } catch(GuzzleException $exception) {
            abort(401, $exception->getMessage());
        }

        return json_decode($response->getBody(), true)['access_token'];
    }

    /**
     * @return mixed
     */
    public function createOrder()
    {

        $token = $this->getToken();

        // todo refactor ASAP!!!

        $newClient = new Client([
            'headers'=> [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ]
        ]);

        $headers= [
            'Content-Type'=>'application/json',
            'Authorization'=> 'Bearer '.$token
        ];

        $data = [
            'notifyUrl'=> 'http://larashop.local/LaraShop/public',
            'continueUrl'=> 'http://larashop.local/LaraShop/public',
            'customerIp'=>request()->ip(),
            'merchantPosId' => config('payment.payU.pos_id'),
            'description' => 'Testowa platność',
            'currencyCode' => 'PLN',
            'totalAmount' => '100',

            "buyer" => [
                "email"=> "john.doe@example.com",
                "phone"=> "654111654",
                "firstName"=> "John",
                "lastName"=> "Doe",
                "language"=> "pl"
            ],

            'settings' => [
                "invoiceDisabled" => "true"
            ],

            'products' => [
                [
                    'name' => 'Zabawkowy odkurzacz',
                    'unitPrice' => '100',
                    'quantity' => '1'
                ]
            ],
        ];

        $data2 = json_encode($data);

        $request = new Request('POST', config('payment.payU.order_endpoint'), $headers, $data2);
        $response = $newClient->send($request, ['allow_redirects' => false]);

        $data = json_decode($response->getBody(), true);
//        dd($data['redirectUri']);


        return $data['redirectUri'];
    }
}
