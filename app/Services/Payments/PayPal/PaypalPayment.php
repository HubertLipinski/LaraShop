<?php

namespace App\Services\Payments\PayPal;

use App\Events\Payment\OrderCompleted;
use App\Exceptions\Payment\Paypal\PaypalPaymentException;
use App\Http\Requests\CreateCheckoutRequest;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Services\Payments\PaymentBase;
use App\Services\Payments\PayPal\Models\PurchaseUnits;
use App\Services\Payments\PayPal\Models\Unit;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;

class PaypalPayment extends PaymentBase
{
    private $purchaseUnits;
    private $order;
    private $paymentHistory;

    /**
     * PaypalPayment constructor.
     * @param Order $order
     * @param PaymentHistory $paymentHistory
     */
    public function __construct(Order $order, PaymentHistory $paymentHistory) {
        parent::__construct();
        $this->http = $this->createHttp();
        $this->purchaseUnits = new PurchaseUnits();
        $this->order = $order;
        $this->paymentHistory = $paymentHistory;
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
        $items = $params['items_list'];
        foreach($items as $item) {
            $product = Product::findOrFail($item['id']);
            $unit = new Unit($product->name, $product->price * (int)$item['qty']);
            $this->purchaseUnits->addUnit($unit);
        }
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
                        "return_url" => config('app.url') . '/payment-summary/paypal',
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
    public function pay(CreateCheckoutRequest $request, int $address) : void {
        $this->createRequest($request->validated());
        $response = $this->sendRequest();
        $link = $response->get('links')[1]['href'];

        $payment = $this->paymentHistory->create([
            'user_id' => Auth::user()->id,
            'payment_providers_id' => 1,
            'payment_provider_order_id' => $response->get('id'),
            'order_status' => $response->get('status')
        ]);

        $order = $this->order->create([
            'user_address_id' => $address,
            'cart_id' => Auth::user()->cart->id,
            'payment_histories_id' => $payment->id,
            'value' => $request['total_price'],
            'status' => 'STARTED',
        ]);

        redirect($link)->send();
        $this->clearCart();
        event(new OrderCompleted($order));
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
