<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCheckoutRequest;
use App\Models\SavedAddress;
use App\Models\User;
use App\Services\Payments\Models\CreateOrderModel;
use App\Services\Payments\Payment;
use App\Providers\PaymentProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $payment;

    /**
     * CheckoutController constructor.
     * @param Payment $payment
     * @param User $user
     */
    public function __construct(Payment $payment)
    {
        $this->middleware('auth');
        $this->payment = $payment;
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

        $orderModel = new CreateOrderModel(Auth::user());
        $orderModel->createFromSavedAddress($address);

        dd($orderModel->toArray());

        $url = $this->payment->createOrder();
        return redirect($url);
    }
}
