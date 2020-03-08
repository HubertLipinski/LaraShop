<?php

namespace App\Services\Payments\Models;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class PaymentProductList implements Arrayable, Jsonable
{

    private $productList = [];

    public function add(PaymentProductModel $product)
    {
        array_push($this->productList, $product->toArray());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->productList;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->productList, $options);
    }
}
