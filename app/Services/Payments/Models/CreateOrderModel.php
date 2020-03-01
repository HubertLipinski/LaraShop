<?php

namespace App\Services\Payments\Models;

use App\Models\SavedAddress;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;

class CreateOrderModel implements Arrayable
{

    private $config;
    private $address;
    private $buyer;
    private $products;


    public function __construct(User $user, SavedAddress $address)
    {
//        $this->createFromSavedAddress($address);
    }

    public function toArray(): array
    {
        return [
                'notifyUrl'=> 'notifyurl',
                'continueUrl'=> config('app.url'),
                'customerIp' => request()->ip(),
                'merchantPosId' => config('payment.payU.pos_id'),

                'description' => 'Testowa platność',
                'currencyCode' => 'PLN',
                'totalAmount' => '100',

                "buyer" => $this->address->toArray(),

                'settings' => [
                    "invoiceDisabled" => "true"
                ],

                'products' => [
                    [
                        'name' => 't',
                        'unitPrice' => '100',
                        'quantity' => '1'
                    ]
                ],
            ];
    }
}
