<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class MealsDashboardRequest extends FormRequest
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
            'image' => 'nullable|image',
            'name_ar' => 'required|string|min:2|max:255',
            'name_en' => 'required|string|min:2|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'id' => [
                'nullable',
                'exists:meals,id',
                Rule::requiredIf(function () {
                    return Request::routeIs('meals.update_new');
                })
            ],
        ];
    }
}
