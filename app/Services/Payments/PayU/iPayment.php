<?php

namespace App\Services\Payments\PayU;

interface iPayment
{
    /**
     * @return mixed
     */
    public function createOrder(): array;
}
