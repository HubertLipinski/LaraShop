<?php

namespace App\Listeners\Payment;

use App\Events\Payment\OrderCompleted;
use App\Services\Payments\PayPal\PaypalPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CapturePayment implements ShouldQueue
{

    private $paypalPayment = null;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaypalPayment $paypalPayment)
    {
        $this->paypalPayment = $paypalPayment;
    }

    /**
     * Handle the event.
     *
     * @param OrderCompleted $order
     * @return void
     */
    public function handle(OrderCompleted $order)
    {
       $order = $order->getOrder();
       Log::info($order->payment);
//       Log::info($this->paypalPayment->capturePayment());
    }

    public function shouldQueue()
    {
        return true;
    }
}
