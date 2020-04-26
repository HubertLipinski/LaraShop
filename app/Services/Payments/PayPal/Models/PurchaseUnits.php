<?php

namespace App\Services\Payments\PayPal\Models;

use Illuminate\Contracts\Support\Arrayable;

class PurchaseUnits implements Arrayable
{
    private $units = array();

    public function addUnit(Unit $unit) : void
    {
        array_push($this->units, $unit->toArray());
    }

    public function hasUnits() : bool
    {
        return (count($this->units) > 0) ? true : false;
    }

    /**
     * @inheritDoc
     */
    public function toArray() : array
    {
        return $this->units;
    }
}
