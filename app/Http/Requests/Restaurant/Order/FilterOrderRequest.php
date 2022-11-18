<?php

namespace App\Http\Requests\Restaurant\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class FilterOrderRequest extends FormRequest
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
            'date_from' => 'sometimes|date_format:Y-m-d',
            'date_to' => 'sometimes|date_format:Y-m-d',
            'time_from' => 'sometimes|date_format:H:i',
            'time_to' => 'sometimes|date_format:H:i',
            'status' => 'sometimes|inincoming,on_processing,on_delivery,delivered,cancelled',
        ];
    }
}
