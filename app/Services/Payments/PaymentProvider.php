<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\PaymentHistory;
use App\Services\Payments\PayPal\PaypalPayment;
use App\Services\Payments\PayU\PayuPayment;

class PaymentProvider
{
    public $paypal;
    public $payu;
    private $order;
    private $paymentHistory;

    /**
     * PaymentController constructor.
     * @param PaypalPayment $paypal
     * @param PayuPayment $payu
     * @param Order $order
     * @param PaymentHistory $paymentHistory
     */
    public function __construct(
        PaypalPayment $paypal,
        PayuPayment $payu,
        Order $order,
        PaymentHistory $paymentHistory)
    {
        $this->paypal = $paypal;
        $this->payu = $payu;
        $this->order = $order;
        $this->paymentHistory = $paymentHistory;
    }



}
