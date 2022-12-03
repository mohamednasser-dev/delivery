<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
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
            'image' => ['nullable','mimes:jpeg,jpg,png,svg','max:10000',
                Rule::requiredIf($this->routeIs('sections.store'))],
            'name_ar' => 'required',
            'name_en' => 'required',
        ];
    }
}
