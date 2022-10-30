<?php

namespace App\Http\Requests\Restaurant\Meal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class AddItemMealRequest extends FormRequest
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
            'type' => 'required|in:addon,attribute,option',
            'id' => 'required',
            'meal_id' => 'required|exists:meals,id',
            'active' => 'required|in:1,0',
        ];
    }
}
