<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Services\Payments\PayU\OldPayuPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SummaryController extends Controller
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

    public function payu($hash, Request $request)
    {
        dd($hash);
        $payment = $this->paymentHistory->where('order_hash', $hash)->firstOrFail();

        abort_unless(Auth::user()->can('view', $payment), 401);
        $order = $this->order->where('payment_histories_id', $payment->id)->firstOrFail();

        $success = true;
        if($request->has('error')) {
            abort_unless(Auth::user()->can('update', $payment), 401);
            $payment->update(['order_status' => 'DECLINED']);
            $success = false;
        } else if (empty($request->all())) {
            abort_unless(Auth::user()->can('update', $payment), 401);
            $payment->update(['order_status' => 'SUCCESS']);
        }

        return view('layouts.paymentSummary')
            ->with([
                'success' => $success,
                'code' => $request->has('error') ? $request->error : 200,
                'order' => $order,
                'payment'=> $payment
            ]);
    }

    public function paypal(Request $request) {
        $token = $request->get('token');
        $payment = $this->paymentHistory->where('payment_provider_order_id', $token)->first();
        $order = $this->order->where('payment_histories_id', $payment->id)->first();
        //todo update
        return view('layouts.paymentSummary')
            ->with([
                'success' => true,
                'code' => $request->has('error') ? $request->error : 200,
                'order' => $order,
                'payment'=> $payment
            ]);
    }
}
