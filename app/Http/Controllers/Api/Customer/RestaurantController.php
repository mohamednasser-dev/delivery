<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\CustomerMealResources;
use App\Http\Requests\Customer\MealDetailsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\RestaurantDetailsMenuMealsResources;
use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Request;


class RestaurantController extends Controller
{
    public function restaurantDetailsMenuMeals(Request $request)
    {
//        $data = $request->validated();
        $data = Restaurant::accepted()->active()->findOrFail(request()->restaurant_id);
        $data =  new RestaurantDetailsMenuMealsResources($data);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function searchRestaurantDetailsMenuMeals(Request $request)
    {
//        $data = $request->validated();
        $data = Restaurant::accepted()->active()->findOrFail(request()->restaurant_id);
        $data =  new RestaurantDetailsMenuMealsResources($data);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function mealDetails(Request $request)
    {
//        $data = $request->validated();
        $data = Meal::accepted()->active()->findOrFail(request()->meal_id);
        $data =  new CustomerMealResources($data);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

}
