<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'phone' => 'sometimes|string|unique:customers,phone|max:20',
            'notification' => 'sometimes|in:0,1',
            'lat' => 'sometimes',
            'lng' => 'sometimes',
            'address' => 'sometimes',
            'fcm_token' => 'sometimes',
        ];
    }
}
