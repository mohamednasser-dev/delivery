<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\CustomerMealResources;
use App\Http\Requests\Customer\MealDetailsRequest;
use App\Http\Controllers\Controller;
use App\Models\Meal;


class RestaurantController extends Controller
{

    public function meal_details(MealDetailsRequest $request)
    {
        $data = $request->validated();
        $data = Meal::accepted()->active()->findOrFail($data['meal_id']);
        $data =  new CustomerMealResources($data);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

}
