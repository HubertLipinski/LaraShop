<?php

namespace App\Services\Payments\Models;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Psy\Util\Json;

class PaymentModel implements Arrayable, Jsonable
{

    private $payuData;
    private $paymentUserData;
    private $paymentProductList;
    private $description;
    private $amount;


    public function __construct(PaymentUserData $paymentUserData) {
        $this->paymentUserData = $paymentUserData;
        $this->description = 'Testowa płatność';
        $this->amount = 100;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount) : void {
        $this->amount = $amount * 100;
    }


    public function toArray(): array {
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
     * @return Json
     */
    public function toJson($options = 0) : Json {
        return json_encode($this->toArray(), $options);
    }
}
