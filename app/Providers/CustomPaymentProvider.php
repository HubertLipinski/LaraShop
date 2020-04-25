<?php

namespace App\Providers;

use App\Models\PaymentHistory;
use App\Services\Payments\PaymentBase;
use App\Services\Payments\PaymentProvider;
use App\Services\Payments\PayU\PayuPayment;
use App\Services\Payments\PayPal\PaypalPayment;
use Illuminate\Support\ServiceProvider;

class CustomPaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentProvider::class, function (){
            return new PaymentProvider(
                $this->app->make(PaypalPayment::class),
                $this->app->make(PayuPayment::class)
                //add more models
            );
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
