<?php

namespace App\Exceptions\Payment\Paypal;

use Exception;
use Illuminate\Support\Facades\Log;

class PaypalPaymentException extends Exception
{

    /**
     * PaypalPaymentException constructor.
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 406);
    }

    public function report()
    {
        Log::info('PayPal Payment Error!');
    }

}
