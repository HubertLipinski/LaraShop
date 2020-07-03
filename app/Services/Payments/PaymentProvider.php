<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\SavedAddress;
use App\Services\Payments\PayPal\PaypalPayment;
use App\Services\Payments\PayU\PayuPayment;

class PaymentProvider
{
    public $paypal;
    public $payu;
    public $order;
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

    /**
     * @param array $params
     * @return int id of SavedAddress model
     */
    public function checkSavedAddress(array $params) : int {
        if(!isset($params['saved_address'])) {
            $address = new SavedAddress($params);
            $address->fill(['user_id'=>auth()->id()]);
            $address->save();
            return $address->id;
        }
        return $params['saved_address'];
    }

}
