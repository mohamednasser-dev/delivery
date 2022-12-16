<?php

namespace App\Http\Requests\Admin;

use App\Models\Coupon;
use App\Models\Meal;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'code' => ['required', 'string', 'min:1', 'max:150'],
            'from_date' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'to_date' => 'required|date|after_or_equal:from_date',
            'amount' => 'required|numeric|min:0',
            'min_order_price' => 'required|numeric|min:0',
//            'type' => ['required', Rule::in(Coupon::TYPE)],
            'usage_count' => 'required|numeric|min:0',
        ];
    }
}
