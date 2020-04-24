<?php

namespace App\Services\Payments\PayPal;

use App\Events\Payment\OrderCompleted;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Services\Payments\PaymentBase;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Event;

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
        try {
            $response = $this->http->post(config('payment.paypal.oauth_endpoint'), [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
                'auth' => [
                    config('payment.paypal.client_id'),
                    config('payment.paypal.client_secret'),
                ]
            ]);
        } catch(GuzzleException $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
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
    public function sendRequest()
    {
        $this->checkToken();

        try {
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
        } catch(GuzzleException $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }

//        $order = Order::findOrFail(1);
//        event(new OrderCompleted($order));

        return $this->decodeJson($response);
        //user aprove request then capture
        //config('payment.paypal.order_endpoint')/ORDER_ID/capture
    }

    public function caputrePayment(PaymentHistory $payment)
    {
        $this->checkToken();
        try {
            $orderId = $payment->payment_provider_order_id;
            $captureUrl = config('payment.paypal.order_endpoint') . '/' . $orderId . '/capture';
            $response = $this->http->post($captureUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ]
            ]);
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }

        //event paymentCaptured($payment->id)
    }

}
