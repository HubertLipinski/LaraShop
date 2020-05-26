<?php

namespace App\Services\Payments\PayPal;

use App\Exceptions\Payment\Paypal\PaypalPaymentException;
use App\Http\Requests\CreateCheckoutRequest;
use App\Models\PaymentHistory;
use App\Services\Payments\PaymentBase;
use App\Services\Payments\PayPal\Models\PurchaseUnits;
use App\Services\Payments\PayPal\Models\Unit;
use GuzzleHttp\Exception\GuzzleException;

class PaypalPayment extends PaymentBase
{
    private $purchaseUnits;

    /**
     * PaypalPayment constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->http = $this->createHttp();
        $this->purchaseUnits = new PurchaseUnits();
    }

    /**
     * @inheritDoc
     */
    public function getToken(): String {
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
     * @param array $params CreateCheckoutRequest fields
     */
    public function createRequest(array $params) : void {
        $unit = new Unit("Test", 1);
        $this->purchaseUnits->addUnit($unit);
    }

    /**
     * @inheritDoc
     */
    public function sendRequest() {
        $this->checkToken();
        try {
           if (!$this->purchaseUnits->hasUnits())
               throw new PaypalPaymentException('Class PaypalPayment has no payment units!');
           $response = $this->http->post(config('payment.paypal.order_endpoint'), [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'json' => [
                    "intent" => "CAPTURE",
                    "purchase_units" => $this->purchaseUnits->toArray(),
                    "application_context" =>[
                        "return_url" => config('app.url'),
                        "cancel_url"=> "",
                    ]
                ]
            ]);
        } catch(\Exception $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }

        return $this->decodeJson($response);
    }

    /**
     * @inheritDoc
     */
    public function pay(CreateCheckoutRequest $request) : void {
        $this->createRequest($request->validated());
        $link = $this->sendRequest()->get('links')[1]['href'];

        redirect($link)->send();
    }

    public function caputrePayment(PaymentHistory $payment) : void {
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
    }

}
