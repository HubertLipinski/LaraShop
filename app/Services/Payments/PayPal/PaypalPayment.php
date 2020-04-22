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
        $response = $this->http->post(config('payment.paypal.oauth_endpoint'), [
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
        if(!$this->token)
            $this->token = $this->getToken();

        $response = $this->http->post(config('payment.paypal.order_endpoint'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'json' => [
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "reference_id" => "test",
                        "amount" => [
                            "currency_code" => "PLN",
                            "value" => "1.0"
                        ]
                    ]
                ],
                "application_context" =>[
                    "return_url" => config('app.url'),
                    "cancel_url"=> "",
                ]
            ]
        ]);

        dd($this->decodeJson($response));
        //user aprove request then capture
        //config('payment.paypal.order_endpoint')/ORDER_ID/capture
    }
}
