<?php

namespace App\Services\Payments;

use App\Models\SavedAddress;
use App\Models\User;
use App\Services\Payments\Models\PaymentUserData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class Payment implements iPayment
{
    private $client;

    private $config;
    private $address;
    private $buyer;
    private $products;

    /**
     * Payment constructor.
     * @param User $user
     * @param SavedAddress $address
     */
    public function __construct(User $user)
    {
        //
    }

    /**
     * @param PaymentUserData $address
     */
    public function setAddress(SavedAddress $address): void
    {
        $this->address = new PaymentUserData(Auth::user(), $address);
    }

    protected function createHttp(String $token = ''): Client
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];
        if (strlen($token)>0)
            $headers['Authorization'] = 'Bearer '.$token;

        return new Client(['headers' => $headers]);
    }

    /*
     * Returns Oauth token received from PayU API
     */
    protected function getToken(): String
    {
        $client = $this->createHttp();

        try {
            $response = $client->request('POST',config('payment.payU.oauth_endpoint'), [
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
        $client = $this->createHttp($token);

        $notifyUrl = config('app.url').'/api/pay-u/notify';

        $data = [
            'notifyUrl'=> $notifyUrl,
            'continueUrl'=> config('app.url'),
            'customerIp' => request()->ip(),
            'merchantPosId' => config('payment.payU.pos_id'),
            'description' => 'Testowa platność',
            'currencyCode' => 'PLN',
            'totalAmount' => '100',

            "buyer" => $this->address->toArray(),

            'settings' => [
                "invoiceDisabled" => "true"
            ],

            'products' => [
                [
                    'name' => 't',
                    'unitPrice' => '100',
                    'quantity' => '1'
                ]
            ],
        ];

        $formData = json_encode($data);

        $request = new Request('POST',
            config('payment.payU.order_endpoint'),
            $client->getConfig('headers'),
            $formData
        );

        $response = $client->send($request, ['allow_redirects' => false]);
        $data = json_decode($response->getBody(), true);

        return $data['redirectUri'];
    }
}
