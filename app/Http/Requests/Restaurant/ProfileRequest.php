<?php

namespace App\Http\Requests\Restaurant;

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
            'logo' => 'sometimes|image',
            'name_ar' => 'sometimes|string|min:2|max:255',
            'name_en' => 'sometimes|string|min:2|max:255',
            'crn' => 'sometimes|string|min:2|max:255',
            'restaurant_type_id' => 'sometimes|exists:restaurant_types,id',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
            'full_name' => 'sometimes|string|min:2|max:255',
            'national_id' => 'sometimes|numeric',
            'email' => 'sometimes|email|unique:restaurants,email',
            'nationality_id' => 'sometimes|exists:nationalities,id',
            'phone' => 'sometimes|string|unique:restaurants,phone|max:20',
            'owner_type_id' => 'sometimes|exists:owner_types,id',
        ];
    }
}
