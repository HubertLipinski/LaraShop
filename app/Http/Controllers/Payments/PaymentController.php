<?php

namespace App\Http\Controllers\Payments;

use App\Events\Payment\OrderCompleted;
use App\Http\Controllers\Controller;
use App\Services\Payments\PaymentProvider;
use App\Services\Payments\PayU\iPayment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    private $paymentProvider;

    /**
     * CartController constructor.
     * @param PaymentProvider $paymentProvider
     */
    public function __construct(PaymentProvider $paymentProvider)
    {
        $this->paymentProvider = $paymentProvider;
    }

    public function test() {
        $this->paymentProvider->paypal->createRequest([]);
       dd($this->paymentProvider->paypal->sendRequest());
    }

    public function paymentSuccessful(Request $request)
    {

//        event(new OrderCompleted($order));
//        wyswietlenie podsumowania
    }
}
