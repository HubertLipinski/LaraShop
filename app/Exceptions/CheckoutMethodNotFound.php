<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class CheckoutMethodNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct('Payment Method not found', 503);
    }

    public function report()
    {
        Log::info('Payment Method not found!');
    }
}
