<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'saved_address' => 'sometimes|required|string',
            'payment_option' => 'required|integer',
            'items_list' => 'required|array',
            'items_list.*.qty' => 'required|integer',
            'items_list.*.id' => 'required|integer',
            'total_price' => 'required|integer|nullable|min:1',

            'name' => 'sometimes|required_without:saved_address,',
            'surname' => 'sometimes|required_without:saved_address',
            'address' => 'sometimes|required_without:saved_address',
            'number' => 'sometimes|required_without:saved_address',
            'city' => 'sometimes|required_without:saved_address',
            'voivodeship' => 'sometimes|required_without:saved_address',
            'zip_code' => 'sometimes|required_without:saved_address',
        ];
    }
}
