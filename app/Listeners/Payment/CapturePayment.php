<?php

namespace App\Listeners\Payment;

use App\Events\Payment\OrderCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CapturePayment implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OrderCompleted $order
     * @return void
     */
    public function handle(OrderCompleted $order)
    {
       Log::info('CapturePayment');
    }

    public function shouldQueue()
    {
        return true;
    }
}
