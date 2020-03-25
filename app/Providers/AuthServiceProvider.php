<?php

namespace App\Providers;

use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\SavedAddress;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => 'App\Policies\ProductsPolicy',
        PaymentHistory::class => 'App\Policies\PaymentHistoryPolicy',
        SavedAddress::class => 'App\Policies\SavedAddressPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
