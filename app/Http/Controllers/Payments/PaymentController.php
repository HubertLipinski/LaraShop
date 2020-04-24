<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Services\Payments\PaymentProvider;

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
       dd($this->paymentProvider->payu->getToken());
    }

}
