<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class OptionsDashboardRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'attribute_id' => [
                'nullable',
                'exists:attributes,id',
                Rule::requiredIf(function () {
                    return Request::routeIs('options.store');
                })
            ],
            'id' => [
                'nullable',
                'exists:options,id',
                Rule::requiredIf(function () {
                    return Request::routeIs('options.update_new');
                })
            ],
        ];
    }
}
