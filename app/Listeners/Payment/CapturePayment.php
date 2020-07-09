<?php

namespace App\Listeners\Payment;

use App\Events\Payment\OrderCompleted;
use App\Mail\OrderPlaced;
use App\Services\Payments\PayPal\PaypalPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CapturePayment implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
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
       $user = $order->cart->user;
       Mail::to($user)->send(new OrderPlaced($order));
    }

    public function shouldQueue()
    {
        return true;
    }
}
