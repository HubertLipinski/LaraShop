<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\SavedAddress;
use App\Services\Payments\Models\CreateOrderModel;
use App\Services\Payments\Models\PaymentPayuData;
use App\Services\Payments\Models\PaymentProductList;
use App\Services\Payments\Models\PaymentProductModel;
use App\Services\Payments\Models\PaymentUserData;
use App\Services\Payments\Models\PayuResponseModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Payment implements iPayment
{
    private $orderModel;
    private $paymentHistoryModel;
    private $address;
    private $amount;
    private $paymentProductList;

    /**
     * Payment constructor.
     * @param Order $order
     * @param PaymentHistory $paymentHistory
     */
    public function __construct(Order $order, PaymentHistory $paymentHistory)
    {
        $this->orderModel = $order;
        $this->paymentHistoryModel = $paymentHistory;
    }

    /**
     * @param SavedAddress $address
     */
    public function setAddress(SavedAddress $address): void
    {
        $this->address = new PaymentUserData(Auth::user(), $address);
    }

    /**
     * @param mixed $products
     */
    public function setProducts(Collection $products): void
    {
        $paymentProductList = new PaymentProductList();
        foreach ($products as $product) {
            $paymentProduct = new PaymentProductModel(
                $product->name,
                $product->price,
                $product->pivot->qty
            );
            $paymentProductList->add($paymentProduct);
        }
        $this->paymentProductList = $paymentProductList;
    }

    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    protected function createHttp(string $token = ""): Client
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
    public function createOrder(): array
    {
        $token = $this->getToken();
        $client = $this->createHttp($token);

        $createOrderModel = new CreateOrderModel(
            new PaymentPayuData(),
            $this->address,
            $this->paymentProductList
        );
        $createOrderModel->setDescription('Platnosc testowa');
        $createOrderModel->setAmount($this->amount);

        $formData = $createOrderModel->toJson();
        $request = new Request('POST',
            config('payment.payU.order_endpoint'),
            $client->getConfig('headers'),
            $formData
        );
        $response = $client->send($request, ['allow_redirects' => false]);
        $responseModel = new PayuResponseModel($response);

        $paymentRecord = $this->paymentHistoryModel->create([
            'user_id' => Auth::user()->id,
            'payment_provider_order_id' => $responseModel->getOrderId(),
            'order_status' => $responseModel->getResponseStatus()
        ]);

        $response = [
            'paymentId' => $paymentRecord->id,
            'redirectUri' => $responseModel->getRedirectUri(),
            'paymentStatus' => $paymentRecord->order_status
        ];

        $this->clearCart();

        return $response;
    }

    private function clearCart()
    {
        $cart = Auth::user()->cart;
        $cart->delete();
        Auth::user()->cart()->create();
    }
}
