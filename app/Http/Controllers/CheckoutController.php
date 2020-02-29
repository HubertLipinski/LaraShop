<?php

namespace App\Http\Controllers;

use App\Services\Payments\Payment;
use App\Providers\PaymentProvider;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $Payment;

    /**
     * CheckoutController constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->middleware('auth');
        $this->Payment = $payment;
    }

    public function checkout(Request $request)
    {
//        dd($request->all());
        $url = $this->Payment->createOrder();
        return redirect($url);
    }
}
