<?php

namespace App\Services\Payments\Models;

use Illuminate\Contracts\Support\Arrayable;

class PaymentProductModel implements Arrayable
{

    private $name;
    private $unitPrice;
    private $quantity;

    /**
     * PaymentProductModel constructor.
     * @param $name
     * @param $unitPrice
     * @param $quantity
     */
    public function __construct(string $name, int $unitPrice, int $quantity)
    {
        $this->name = $name;
        $this->unitPrice = $unitPrice * 100;
        $this->quantity = $quantity;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'unitPrice' => $this->unitPrice,
            'quantity' => $this->quantity,
        ];
    }
}
