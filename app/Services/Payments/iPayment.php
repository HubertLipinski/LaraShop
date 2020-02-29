<?php

namespace App\Services\Payments;

interface iPayment
{
    /**
     * @return mixed
     */
    public function createOrder();
}
