<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\RestaurantReviewIndexRequest;
use App\Http\Resources\Customer\CustomerMealResources;
use App\Http\Requests\Customer\MealDetailsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\RestaurantDetailsMenuMealsResources;
use App\Http\Resources\Customer\RestaurantMealsOfCategoryResources;
use App\Models\Category;
use App\Models\CategoryMeal;
use App\Models\Meal;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Request;


class RestaurantController extends Controller
{
    public function restaurantDetailsMenuMeals(RestaurantReviewIndexRequest $request)
    {
        $data = $request->validated();
        $id = $data['restaurant_id'];
        $data = Restaurant::accepted()->active()->findOrFail($id);
        $data =  new RestaurantDetailsMenuMealsResources($data);
        if(request()->category_id){
            $meal_ids = CategoryMeal::where('restaurant_id',$id)
                ->where('category_id',request()->category_id)
                ->pluck('meal_id')->toArray();
            $mealsOfFirstRestaurantCategory = Meal::accepted()->active()
                ->where('restaurant_id',$id)
                ->whereIn('id',$meal_ids)
                ->paginate(pagination_number());
            $mealsOfFirstRestaurantCategory = (RestaurantMealsOfCategoryResources::collection($mealsOfFirstRestaurantCategory))->response()->getData(true);

            return $this->sendSuccessData(__('lang.data_show_successfully'),
                $mealsOfFirstRestaurantCategory
            );
        }else{
            $meal_ids = CategoryMeal::where('restaurant_id',$id)
                ->where('category_id',request()->category_id)
                ->take(1)
                ->pluck('meal_id')->toArray();
            $mealsOfFirstRestaurantCategory = Meal::accepted()->active()
                ->where('restaurant_id',$id)
//                ->whereIn('id',$meal_ids)
                ->paginate(pagination_number());
            $mealsOfFirstRestaurantCategory = (RestaurantMealsOfCategoryResources::collection($mealsOfFirstRestaurantCategory))->response()->getData(false);
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

        if ($data){
            $data =  new CustomerMealResources($data);
            return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
        }
        return $this->sendError(__('lang.error'));

    }

}
