<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'image' => 'nullable|mimes:jpeg,jpg,png|max:10000',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('id')),
            ],
            'phone' => [
                'required',
                Rule::unique('users', 'phone')->ignore($this->route('id')),
            ],
            'role_id' => 'required|exists:roles,id',
            'password' => [
                'nullable',
                'min:6',
                'confirmed',
                Rule::requiredIf($this->routeIs('users.store')),
            ],
        ];
    }
}
