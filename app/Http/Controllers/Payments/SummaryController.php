<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SummaryController extends Controller
{
    private $order;
    private $paymentHistory;

    /**
     * CheckoutController constructor.
     * @param Order $order
     * @param PaymentHistory $paymentHistory
     */
    public function __construct(Order $order, PaymentHistory $paymentHistory)
    {
        $this->middleware('auth');
        $this->order = $order;
        $this->paymentHistory = $paymentHistory;
    }

    public function payu(Request $request)
    {
        if(!$request->exists('cart'))
            abort(500);
        $order =  $this->order->where('cart_id', $request->get('cart'))->firstOrFail();
        abort_unless(Auth::user()->can('view', $order), 401);
        $payment = $order->payment;

        return view('layouts.paymentSummary')
            ->with([
                'success' => !$request->has('error'),
                'code' => $request->has('error') ? $request->error : 200,
                'order' => $order,
                'payment'=> $payment
            ]);
    }

    public function paypal(Request $request) {
        if(!$request->exists('token'))
            abort(500);
        $token = $request->get('token');
        $payment = $this->paymentHistory->where('payment_provider_order_id', $token)->firstOrFail();
        $order = $this->order->where('payment_histories_id', $payment->id)->firstOrFail();
        abort_unless(Auth::user()->can('view', $order), 401);

        return view('layouts.paymentSummary')
            ->with([
                'success' => true,
                'code' => $request->has('error') ? $request->error : 200,
                'order' => $order,
                'payment'=> $payment
            ]);
    }
}
