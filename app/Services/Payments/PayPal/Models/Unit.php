<?php

namespace App\Services\Payments\PayPal\Models;

use Illuminate\Contracts\Support\Arrayable;

class Unit implements Arrayable
{
    private $referenceId;
    private $currencyCode;
    private $value;

    /**
     * Unit constructor.
     * @param $referenceId
     * @param $currencyCode
     * @param $value
     */
    public function __construct(String $referenceId, int $value, String $currencyCode = 'PLN') {
        $this->referenceId = $referenceId;
        $this->value = $value;
        $this->currencyCode = $currencyCode;
    }


    /**
     * @inheritDoc
     */
    public function toArray() : array {
        return [
            'reference_id' => $this->referenceId,
            'amount' => [
                'currency_code' => $this->currencyCode,
                'value' => $this->value
            ]
        ];
    }
}
