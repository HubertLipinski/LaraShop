<?php

namespace App\Services\Payments\Models;

use Illuminate\Contracts\Support\Arrayable;

class CreateOrderModel implements Arrayable
{

    private $payuData;
    private $paymentUserData;
    private $products;
    private $description;
    private $amount;


    public function __construct(PaymentPayuData $payuData, PaymentUserData $paymentUserData)
    {
        $this->payuData = $payuData;
        $this->paymentUserData = $paymentUserData;
        $this->description = 'Testowa płatność';
        $this->amount = 100;
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
        $this->amount = $amount;
    }


    public function toArray(): array
    {
        return [
                'notifyUrl'=> $this->payuData->getNotifyUrl(),
                'continueUrl'=> $this->payuData->getContinueUrl(),
                'customerIp' => $this->payuData->getCustomerIp(),
                'merchantPosId' => $this->payuData->getMerchantPosId(),

                'description' => $this->description,
                'currencyCode' => 'PLN',
                'totalAmount' => $this->amount,

                'buyer' => $this->paymentUserData->toArray(),

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
