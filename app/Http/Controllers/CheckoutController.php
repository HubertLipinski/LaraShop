<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheckoutRequest;
use App\Models\Cart;
use App\Models\CartPivot;
use App\Models\Order;
use App\Models\Product;
use App\Models\SavedAddress;
use App\Models\User;
use App\Services\Payments\Models\CreateOrderModel;
use App\Services\Payments\Models\PaymentUserData;
use App\Services\Payments\Payment;
use App\Providers\PaymentProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $payment;
    private $order;

    /**
     * CheckoutController constructor.
     * @param Payment $payment
     * @param Order $order
     */
    public function __construct(Payment $payment, Order $order)
    {
        $this->middleware('auth');
        $this->payment = $payment;
        $this->order = $order;
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
        $url = $this->payment->createOrder();

        return redirect($url);
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
