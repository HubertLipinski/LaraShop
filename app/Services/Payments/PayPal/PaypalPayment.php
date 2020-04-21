<?php

namespace App\Services\Payments\PayPal;

use App\Services\Payments\PaymentBase;
use GuzzleHttp\Psr7\Response;

class PaypalPayment extends PaymentBase
{
    /**
     * PaypalPayment constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->http = $this->createHttp();
    }

    /**
     * @inheritDoc
     */
    public function getToken(): String
    {
        $response = $this->http->post('https://api.sandbox.paypal.com/v1/oauth2/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
            'auth' => [
                config('payment.paypal.client_id'),
                config('payment.paypal.client_secret'),
            ]
        ]);
        $response = $this->decodeJson($response);
        return $response->get('access_token');
    }

    /**
     * @inheritDoc
     */
    public function createRequest()
    {
        // TODO: Implement createRequest() method.
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(): Response
    {
        // TODO: Implement sendRequest() method.
    }
}
