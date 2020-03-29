<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class SavedAddressUpdateRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'display_name' => 'required|string',
            'name' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'zip_code' => 'required|alpha_dash|between:5,6',
            'city' => 'required|string',
            'country' => 'required|string',
            'number' => 'required|numeric|digits:11',
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['error' => $errors], 400);
    }
}
