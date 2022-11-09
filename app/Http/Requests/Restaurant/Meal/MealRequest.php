<?php

namespace App\Http\Requests\Restaurant\Meal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class MealRequest extends FormRequest
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
            'name_ar' => 'required|string|min:2|max:255',
            'name_en' => 'required|string|min:2|max:255',
            'desc_ar' => 'required|string|min:2|max:255',
            'desc_en' => 'required|string|min:2|max:255',
            'price' => 'required|numeric',
            'active' => 'required|in:0,1',
            'category_id' => 'required|exists:categories,id',
            'id' => [
                'nullable',
                'exists:meals,id',
                Rule::requiredIf(function () {
                    return Request::routeIs('meals.update');
                })
            ],
        ];
    }
}
