<?php

namespace App\Services\Payments;

use App\Models\SavedAddress;
use App\Models\User;
use App\Services\Payments\Models\CreateOrderModel;
use App\Services\Payments\Models\PaymentPayuData;
use App\Services\Payments\Models\PaymentUserData;
use App\Services\Payments\Models\PayuResponseModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class Payment implements iPayment
{
    private $address;

    /**
     * @param PaymentUserData $address
     */
    public function setAddress(SavedAddress $address): void
    {
        $this->address = new PaymentUserData(Auth::user(), $address);
    }

    protected function createHttp(String $token = ""): Client
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
            $responseModel = new PayuResponseModel($response);
        } catch(GuzzleException $exception) {
            abort(401, $exception->getMessage());
        }

        return $responseModel->getToken();
    }

    /**
     * @return mixed
     */
    public function createOrder()
    {

        $token = $this->getToken();
        $client = $this->createHttp($token);

        $createOrderModel = new CreateOrderModel(
            new PaymentPayuData(),
            $this->address
        );
        $createOrderModel->setDescription('Platnosc testowa');
        $createOrderModel->setAmount(200);

        $formData = $createOrderModel->toJson();

        $request = new Request('POST',
            config('payment.payU.order_endpoint'),
            $client->getConfig('headers'),
            $formData
        );
        $response = $client->send($request, ['allow_redirects' => false]);

        $responseModel = new PayuResponseModel($response);

        return $responseModel->getRedirectUri();
    }
}
