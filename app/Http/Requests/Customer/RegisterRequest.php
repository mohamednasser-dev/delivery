<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'image' => 'sometimes|image',
            'name' => 'sometimes|string|min:2|max:255',
            'email' => 'sometimes|email|unique:customers,email',
            'phone' => 'required|string|unique:customers,phone',
            'password' => 'min:6',
            'fcm_token' => 'sometimes',
            'notification' => 'sometimes',
            'lat' => 'sometimes',
            'lng' => 'sometimes',
            'address' => 'sometimes',
        ];
    }
}
