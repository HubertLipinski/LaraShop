<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'sometimes|string',
            //'avatar' => 'sometimes|image|mimes:blob,png,jpg',
            'email' => 'required|string|email:rfc,filter',
            'password' => 'sometimes|string|between:8,32',
            'password_confirm' => 'required_with:password|same:password'
        ];
    }
}
