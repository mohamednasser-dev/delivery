<?php

namespace App\Http\Requests\Restaurant\Option;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class OptionRequest extends FormRequest
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
            'active' => 'required|in:0,1',
            'attribute_id' => 'sometimes|exists:attributes,id',
            'id' => [
                'nullable',
                'exists:options,id',
                Rule::requiredIf(function () {
                    return Request::routeIs('options.update');
                })
            ],
        ];
    }
}
