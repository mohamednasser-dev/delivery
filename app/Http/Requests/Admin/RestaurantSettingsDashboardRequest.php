<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantSettingsDashboardRequest extends FormRequest
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
            'id' => 'required|exists:restaurants,id',
            'is_active' => 'nullable',
            'commission' => 'required|numeric|min:0',
            'min_order_price' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'free_delivery' => 'nullable',
            'min_shipping_charge' => 'required|numeric|min:0',
            'min_delivery_time' => 'required|numeric|min:0',
            'max_delivery_time' => 'required|numeric|min:0',
        ];
    }
}
