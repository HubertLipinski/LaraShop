<?php

use App\Models\PaymentProvider;
use Illuminate\Database\Seeder;

class PaymentProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentProvider::create([
            'name' => 'paypal'
        ]);
        PaymentProvider::create([
            'name' => 'payu'
        ]);
    }
}
