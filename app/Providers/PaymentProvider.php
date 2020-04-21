<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\PaymentHistory;
use App\Services\Payments\iPayment;
use App\Services\Payments\Payment;
use App\Services\Payments\PaymentBase;
use App\Services\Payments\PayPal\PaypalPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class PaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(iPayment::class, function (){
            return new Payment(
                Order::class,
                PaymentHistory::class
            );
        });

        $this->app->singleton(PaymentBase::class, function (){
            return new PaypalPayment();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
