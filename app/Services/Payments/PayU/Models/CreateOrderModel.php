<?php

namespace App\Services\Payments\Models;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\Hash;

class CreateOrderModel implements Arrayable, Jsonable
{

    private $payuData;
    private $paymentUserData;
    private $paymentProductList;
    private $description;
    private $amount;
    private $hash;


    public function __construct(PaymentPayuData $payuData, PaymentUserData $paymentUserData, PaymentProductList $paymentProductList)
    {
        $this->payuData = $payuData;
        $this->paymentUserData = $paymentUserData;
        $this->description = 'Testowa płatność';
        $this->amount = 100;
        $this->paymentProductList = $paymentProductList;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount * 100;
    }

    public function hash(): void
    {
        $hash = Hash::make(
            json_encode($this->paymentUserData->toArray())
            . $this->paymentProductList->toJson()
        );
        $this->hash = str_replace ('/', '', $hash);
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    public function toArray(): array
    {
        return [
                'notifyUrl'=> $this->payuData->getNotifyUrl(),
                'continueUrl'=> $this->payuData->getContinueUrl().$this->hash,
                'customerIp' => $this->payuData->getCustomerIp(),
                'merchantPosId' => $this->payuData->getMerchantPosId(),
                'description' => $this->description,
                'currencyCode' => 'PLN',
                'totalAmount' => $this->amount,
                'buyer' => $this->paymentUserData->toArray(),
                'settings' => [
                    'invoiceDisabled' => 'true'
                ],
                'products' => $this->paymentProductList->toArray()
            ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
