<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

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
            'logo' => 'required|image',
            'name_ar' => 'required|string|min:2|max:255',
            'name_en' => 'required|string|min:2|max:255',
            'crn' => 'required|string|min:2|max:255',
            'restaurant_type_id' => 'required|exists:restaurant_types,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'full_name' => 'required|string|min:2|max:255',
            'national_id' => 'required|numeric',
            'email' => 'required|email|unique:restaurants,email',
            'nationality_id' => 'required|exists:nationalities,id',
            'phone' => 'required|string|unique:restaurants,phone|max:20',
            'owner_type_id' => 'required|exists:owner_types,id',
        ];
    }
}
