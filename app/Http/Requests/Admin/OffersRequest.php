<?php

namespace App\Http\Requests\Admin;

use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class OffersRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'target_id' => ['required', Rule::exists((new $this->target_type)->getTable(), 'id')],
            'target_type' => ['required',Rule::in(Restaurant::class,Meal::class)],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png',
                Rule::requiredIf(function () {
                    return \Illuminate\Http\Request::routeIs('offers.store');
                })
            ],
        ];
    }
}
