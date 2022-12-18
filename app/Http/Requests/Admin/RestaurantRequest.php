<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class RestaurantRequest extends FormRequest
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
            'logo' => [
                'nullable',
                'image',
//                'max:1000',
                Rule::requiredIf($this->routeIs('restaurants.store'))
            ],
            'cover' => [
                'nullable',
                'image',
//                'max:1000',
                Rule::requiredIf($this->routeIs('restaurants.store'))
            ],
            'name_ar' => 'required|string|min:2|max:255',
            'name_en' => 'required|string|min:2|max:255',
            'crn' => 'required|string|min:2|max:255',
            'restaurant_type_id' => 'required|exists:restaurant_types,id',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'full_name' => 'required|string|min:2|max:255',
            'national_id' => 'required|numeric',
            'email' => [
                'required',
                'email',
                Rule::unique('restaurants', 'email')->ignore($this->route('id')),
            ],
            'nationality_id' => 'required|exists:nationalities,id',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('restaurants', 'phone')->ignore($this->route('id')),
            ],
            'owner_type_id' => 'required|exists:owner_types,id',

            'password' => [
                'nullable',
                'confirmed',
                'max:20',
                Rule::requiredIf($this->routeIs('restaurants.store')),
            ],
            'sections' => 'required|array|min:1|max:50',
            'sections.*' => ['required', 'integer', Rule::exists('sections', 'id')],
        ];
    }
}
