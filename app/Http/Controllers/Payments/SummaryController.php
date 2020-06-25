<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;

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
        dd($request->all());

//        $payment = $this->paymentHistory->where('order_hash', $hash)->firstOrFail();
//
//        abort_unless(Auth::user()->can('view', $payment), 401);
//        $order = $this->order->where('payment_histories_id', $payment->id)->firstOrFail();
//
//        $success = true;
//        if($request->has('error')) {
//            abort_unless(Auth::user()->can('update', $payment), 401);
//            $payment->update(['order_status' => 'DECLINED']);
//            $success = false;
//        } else if (empty($request->all())) {
//            abort_unless(Auth::user()->can('update', $payment), 401);
//            $payment->update(['order_status' => 'SUCCESS']);
//        }
//
//        return view('layouts.paymentSummary')
//            ->with([
//                'success' => $success,
//                'code' => $request->has('error') ? $request->error : 200,
//                'order' => $order,
//                'payment'=> $payment
//            ]);
    }

    public function paypal(Request $request) {
        $token = $request->get('token');
        $payment = $this->paymentHistory->where('payment_provider_order_id', $token)->first();
        $order = $this->order->where('payment_histories_id', $payment->id)->first();
        return view('layouts.paymentSummary')
            ->with([
                'success' => true,
                'code' => $request->has('error') ? $request->error : 200,
                'order' => $order,
                'payment'=> $payment
            ]);
    }
}
