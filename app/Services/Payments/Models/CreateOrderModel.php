<?php

namespace App\Services\Payments\Models;

use App\Models\SavedAddress;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;

class CreateOrderModel implements Arrayable
{
    private $userModel;
    private $email;
    private $phone;
    private $firstName;
    private $lastName;
    private $language;

    /**
     * CreateOrderModel constructor.
     * @param User $user
     * @param string $language
     */
    public function __construct(User $user, $language = 'pl')
    {
        $this->userModel = $user;
        $this->language = $language;
    }

    /**
     * @param SavedAddress $savedAddress
     */
    public function createFromSavedAddress(SavedAddress $savedAddress): void {
        $this->firstName = $savedAddress->name;
        $this->lastName = $savedAddress->surname;
        $this->phone = $savedAddress->number;
        $this->email = $this->userModel->email;
    }


    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'language' => $this->language
        ];
    }
}
