<?php

namespace App\Services\Payments;

use App\Services\Payments\PayPal\PaypalPayment;
use App\Services\Payments\PayU\PayuPayment;

class PaymentProvider
{
    public $paypal;
    public $payu;

    /**
     * PaymentController constructor.
     * @param $paypal
     * @param $payu
     */
    public function __construct(PaypalPayment $paypal, PayuPayment $payu)
    {
        $this->paypal = $paypal;
        $this->payu = $payu;
    }



}
