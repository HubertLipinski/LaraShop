<?php

namespace App\Services\Payments\PayU;

use App\Http\Requests\CreateCheckoutRequest;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Services\Payments\PaymentBase;
use App\Services\Payments\PayU\Models\Unit;
use App\Services\Payments\PayU\Models\PurchaseUnits;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class PayuPayment extends PaymentBase
{
    private $purchaseUnits;
    private $order;
    private $paymentHistory;
    private $orderValue;

    /**
     * PayuPayment constructor.
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
    public function getToken() : String {
        try {
            $response = $this->http->post(config('payment.payU.oauth_endpoint'), [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('payment.payU.client_id'),
                    'client_secret' => config('payment.payU.client_secret'),
                ],
            ]);

        } catch(GuzzleException $exception) {
            abort(400, $exception->getMessage());
        }

        $response = $this->decodeJson($response);
        return $response->get('access_token');
    }

    /**
     * @param array $params
     */
    public function createRequest(array $params) {
        $this->orderValue = $params['total_price'];
        $items = $params['items_list'];
        foreach($items as $item) {
            $product = Product::findOrFail($item['id']);
            $unit = new Unit($product->name, $product->price, $item['qty']);
            $this->purchaseUnits->addUnit($unit);
        }
    }

    /**
     * @return mixed|void
     */
    public function sendRequest() {
        $this->checkToken();
        $response = $this->http->post(config('payment.payU.order_endpoint'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'allow_redirects' => false,
            'json' => [
                'notifyUrl'=> config('payment.payU.notify'),
                'continueUrl'=> config('app.url') . '/payment-summary/payu',
                'customerIp' => request()->ip(),
                'merchantPosId' => config('payment.payU.pos_id'),
                'description' => 'Płatność z LaraShop',
                'currencyCode' => 'PLN',
                'totalAmount' => $this->orderValue * 100,
                //'buyer' => '',
                'settings' => [
                    'invoiceDisabled' => 'true'
                ],
                'products' => $this->purchaseUnits->toArray()
            ]
        ]);

        return $this->decodeJson($response);
    }

    /**
     * @inheritDoc
     */
    public function pay(CreateCheckoutRequest $request, int $address) {
        $this->createRequest($request->validated());
        $response = $this->sendRequest();
        $link = $response->get('redirectUri');

        $payment = $this->paymentHistory->create([
            'user_id' => Auth::user()->id,
            'payment_providers_id' => 2,
            'payment_provider_order_id' => $response->get('orderId'),
            'order_status' => 'PENDING'
        ]);

        $this->order->create([
            'user_address_id' => $address,
            'cart_id' => Auth::user()->cart->id,
            'payment_histories_id' => $payment->id,
            'value' => $request['total_price'],
            'status' => 'STARTED',
        ]);

        redirect($link)->send();
        $this->clearCart();
    }

}
