<?php

namespace App\Services\Payments\Models;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Support\Arrayable;

class PaymentPayuData implements Arrayable
{
    private $notifyUrl;
    private $continueUrl;
    private $customerIp;
    private $merchantPosId;

    /**
     * PaymentPayuData constructor.
     */
    public function __construct()
    {
        $this->notifyUrl = config('payment.payU.notify');
        $this->continueUrl = config('payment.continue_url');
        $this->customerIp = request()->ip();
        $this->merchantPosId = config('payment.payU.pos_id');
    }

    /**
     * @return Repository|mixed
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @return Repository|mixed
     */
    public function getContinueUrl()
    {
        return $this->continueUrl;
    }

    /**
     * @return string|null
     */
    public function getCustomerIp(): ?string
    {
        return $this->customerIp;
    }

    /**
     * @return Repository|mixed
     */
    public function getMerchantPosId()
    {
        return $this->merchantPosId;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'notifyUrl'=> $this->notifyUrl,
            'continueUrl'=> $this->continueUrl,
            'customerIp' => $this->customerIp,
            'merchantPosId' => $this->merchantPosId,
        ];
    }
}
