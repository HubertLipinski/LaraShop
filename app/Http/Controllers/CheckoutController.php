<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheckoutRequest;
use App\Models\Cart;
use App\Models\CartPivot;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\SavedAddress;
use App\Models\User;
use App\Services\Payments\Models\CreateOrderModel;
use App\Services\Payments\Models\PaymentUserData;
use App\Services\Payments\PayU\OldPayuPayment;
use App\Providers\CustomPaymentProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\IFTTTHandler;

class CheckoutController extends Controller
{
    private $payment;
    private $order;
    private $paymentHistory;

    /**
     * CheckoutController constructor.
     * @param OldPayuPayment $payment
     * @param Order $order
     * @param PaymentHistory $paymentHistory
     */
    public function __construct(OldPayuPayment $payment, Order $order, PaymentHistory $paymentHistory)
    {
        $this->middleware('auth');
        $this->payment = $payment;
        $this->order = $order;
        $this->paymentHistory = $paymentHistory;
    }

    public function checkout(CreateCheckoutRequest $request)
    {
        $fields = $request->validated();

        if(!isset($fields['saved_address'])) {
            $address = new SavedAddress($fields);
            $address->fill(['user_id'=>auth()->id()]);
            $address->save();
        } else {
            $id = $fields['saved_address'];
            $address = SavedAddress::findOrFail($id);
        }

        $productList = $this->updateProducts($fields['items_list']);
        $this->payment->setAddress($address);
        $this->payment->setProducts($productList);
        $this->payment->setAmount($fields['total_price']);
        $orderDetails = $this->payment->createOrder();

       $this->order->create([
           'user_address_id' => $address->id,
           'cart_id' => Auth::user()->cart->id,
           'payment_histories_id' => $orderDetails['paymentId'],
           'value' => $fields['total_price'],
           'status' => $orderDetails['paymentStatus'],
       ]);

        return redirect($orderDetails['redirectUri']);
    }

    private function updateProducts(array $products): Collection
    {
        $cart = Auth::user()->cart;
        foreach($products as $product) {
            $inCart = $cart->items()->wherePivot('product_id', '=', $product['id'])->first();
            $inCart->pivot->update(['qty'=>$product['qty']]);
        }
        return $cart->items;
    }
}
