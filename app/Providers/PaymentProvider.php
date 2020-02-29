<?php

namespace App\Providers;

use App\Services\Payments\iPayment;
use App\Services\Payments\Payment;
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
            return new Payment();
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
