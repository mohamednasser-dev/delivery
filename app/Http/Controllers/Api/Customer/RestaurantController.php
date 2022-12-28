<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\CustomerMealResources;
use App\Http\Requests\Customer\MealDetailsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\RestaurantDetailsMenuMealsResources;
use App\Http\Resources\Customer\RestaurantMealsOfCategoryResources;
use App\Models\Category;
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
        if(request()->category_id){
            $mealsOfFirstRestaurantCategory = Meal::where('restaurant_id',request()->restaurant_id)
                ->where('category_id',request()->category_id)->paginate(pagination_number());
            $mealsOfFirstRestaurantCategory = (RestaurantMealsOfCategoryResources::collection($mealsOfFirstRestaurantCategory))->response()->getData(true);

            return $this->sendSuccessData(__('lang.data_show_successfully'),
                $mealsOfFirstRestaurantCategory
            );
        }else{
            $firstCategory = Category::select('id')->first();
            $mealsOfFirstRestaurantCategory = Meal::where('restaurant_id',request()->restaurant_id)
                ->where('category_id',$firstCategory->id)->paginate(pagination_number());
            $mealsOfFirstRestaurantCategory = (RestaurantMealsOfCategoryResources::collection($mealsOfFirstRestaurantCategory))->response()->getData(true);
            return $this->sendSuccessData(__('lang.data_show_successfully'),
                ['restaurant' => $data , 'meals' => $mealsOfFirstRestaurantCategory]
            );
        }



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
