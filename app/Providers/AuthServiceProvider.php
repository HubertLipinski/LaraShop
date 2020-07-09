<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\SavedAddress;
use App\Models\User;
use App\Models\UserFavourite;
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
        SavedAddress::class => 'App\Policies\SavedAddressPolicy',
        Order::class => 'App\Policies\OrderPolicy',
        User::class => 'App\Policies\UserPolicy',
        UserFavourite::class => 'App\Policies\UserFavouritePolicy',
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
