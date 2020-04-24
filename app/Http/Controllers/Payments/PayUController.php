<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Services\Payments\PayU\PayuPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayUController extends Controller
{

    protected $payment;

    /**
     * CartController constructor.
     * @param PayuPayment $payment
     */
    public function __construct(PayuPayment $payment)
    {
        $this->payment = $payment;
    }

    public function notify(Request $request) {

        Log::debug("Data from PayU", ["request"=>$request->all()]);

        return response("OK", 200);
    }

}
