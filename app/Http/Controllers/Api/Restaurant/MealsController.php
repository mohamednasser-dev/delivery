<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Requests\Restaurant\Meal\AddItemMealRequest;
use App\Http\Requests\Restaurant\Meal\DeleteItemMealRequest;
use App\Http\Requests\Restaurant\Meal\FilterMealRequest;
use App\Http\Requests\Restaurant\Meal\MealDestroyRequest;
use App\Http\Requests\Restaurant\Meal\MealRequest;
use App\Http\Requests\Restaurant\Meal\SearchMealRequest;
use App\Http\Resources\MealResources;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Models\MealAddon;
use App\Models\MealAttribute;
use App\Models\MealAttributeOption;
use App\Models\Option;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class MealsController extends Controller
{

    public function index()
    {
        $posts = Meal::where('restaurant_id', restaurant()->id)->paginate(pagination_number());
        $data = (MealResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function mealsByCategory()
    {
        $category_id = request()->category_id;
        $posts = Meal::where('restaurant_id', restaurant()->id)->where('category_id', $category_id)->paginate(pagination_number());
        $data = (MealResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function store(MealRequest $request)
    {
        $data = $request->validated();
        $restaurant_id = restaurant()->id;
        $meal = Meal::create([
            'image' => $request->image,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'active' => $request->active,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'restaurant_id' => $restaurant_id,
            'status' => 'pending',
        ]);
        if ($meal && isset($request->attributess)) {
            $checkAttribute = Attribute::whereId($request->attributess['id'])
                ->where('restaurant_id', $restaurant_id)
                ->first();
            if ($checkAttribute) {
                $mealAttribute = MealAttribute::create([
                    'restaurant_id' => $restaurant_id,
                    'meal_id' => $meal->id,
                    'attribute_id' => $request->attributess['id'],
                    'active' => $request->attributess['active'],
                ]);
                if ($mealAttribute && isset($request->attributess['options'])) {
                    $checkOption = Option::whereId($request->attributess['options']['id'])
                        ->where('restaurant_id', $restaurant_id)
                        ->first();
                    if ($checkOption) {
                        MealAttributeOption::create([
                            'restaurant_id' => $restaurant_id,
                            'meal_id' => $meal->id,
                            'meal_attribute_id' => $mealAttribute->id,
                            'option_id' => $request->attributess['options']['id'],
                            'active' => $request->attributess['options']['active'],
                            'price' => $request->attributess['options']['price'],
                        ]);
                    }
                }
            }
        }
        if ($meal && isset($request->addons)) {
            foreach ($request->addons as $addon) {
                $checkAddon = Addon::whereId($addon['id'])
                    ->where('restaurant_id', $restaurant_id)
                    ->first();
                if ($checkAddon) {
                    MealAddon::create([
                        'restaurant_id' => $restaurant_id,
                        'meal_id' => $meal->id,
                        'addon_id' => $addon['id'],
                        'active' => $addon['active'],
                        'price' => $addon['price'],
                    ]);
                }

            }
        }
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function update(MealRequest $request)
    {
        $data = $request->validated();
        $restaurant_id = restaurant()->id;
        $meal = Meal::whereId($request->id)->first();
        if ($meal) {
            Meal::whereId($request->id)->where('restaurant_id', $restaurant_id)->update([
                'name_ar' => isset($request->name_ar) ? $request->name_ar : $meal->name_ar,
                'name_en' => isset($request->name_en) ? $request->name_en : $meal->name_en,
                'desc_ar' => isset($request->desc_ar) ? $request->desc_ar : $meal->desc_ar,
                'desc_en' => isset($request->desc_en) ? $request->desc_en : $meal->desc_en,
                'active' => isset($request->active) ? $request->active : $meal->active,
                'price' => isset($request->price) ? $request->price : $meal->price,
                'category_id' => isset($request->category_id) ? $request->category_id : $meal->category_id,
                'status' => 'pending',
            ]);
            if (isset($request->meal_attributes) && sizeof($request->meal_attributes) > 0) {
                //attributes edits
                foreach ($request->meal_attributes as $meal_attribute){
                    $thisMealAttribute = MealAttribute::where('attribute_id',$meal_attribute['id'])
                        ->where('restaurant_id', $restaurant_id)
                        ->where('meal_id', $meal->id)->first();
                    if ($thisMealAttribute) {
                        MealAttribute::where('attribute_id',$meal_attribute['id'])
                            ->where('restaurant_id', $restaurant_id)
                            ->where('meal_id', $meal->id)
                            ->update([
                                'active' => isset($meal_attribute['active']) ? $meal_attribute['active'] : $thisMealAttribute->active,
                            ]);
                    } else {
                        $checkAttribute = Attribute::whereId($meal_attribute['id'])
                            ->where('restaurant_id', $restaurant_id)
                            ->first();
                        if ($checkAttribute) {
                            MealAttribute::create([
                                'restaurant_id' => $restaurant_id,
                                'meal_id' => $meal->id,
                                'attribute_id' => $meal_attribute['id'],
                                'active' => isset($meal_attribute['active']) ?$meal_attribute['active'] : 1,
                            ]);
                        }
                    }
                }

                ////////
            }
            if (isset($request->meal_attributes['meal_attribute_options']) && sizeof($request->meal_attributes['meal_attribute_options']) > 0) {
                //options edits
                foreach ($request->meal_attributes['meal_attribute_options'] as $option) {
                    if (isset($option['id'])) {
                        $thisMealAttributeOption = MealAttributeOption::where('option_id', $option['id'])
                            ->first();
                        if ($thisMealAttributeOption) {
                            MealAttributeOption::where('option_id', $option['id'])
//                                ->where('meal_id', $meal->id)
                                ->update([
                                    'active' => isset($option['active']) ? $option['active'] : $thisMealAttributeOption->active,
                                    'price' => isset($option['price']) ? $option['price'] : $thisMealAttributeOption->price,
                                ]);
                        }
                    } else {
                        MealAttributeOption::create([
                            'restaurant_id' => $restaurant_id,
                            'meal_id' => $request->meal_id,
                            'meal_attribute_id' => $thisMealAttribute->id,
                            'option_id' => $option['id'],
                            'active' => isset($option['active']) ? $option['active'] : 1,
                            'price' => isset($option['price']) ? $option['price'] : 0,
                        ]);
                    }
                }
                ////////////
            }
            if (isset($request->addons)) {
                //addons edits
                foreach ($request->addons as $addon) {
                    $thisMealAddon = MealAddon::where('addon_id', $addon['id'])
                        ->where('meal_id', $meal->id)->first();
                    if ($thisMealAddon) {
                        MealAddon::where('addon_id', $addon['id'])
                            ->where('meal_id', $meal->id)
                            ->update([
                                'active' => isset($addon['active']) ? $addon['active'] : $thisMealAddon->active,
                                'price' => isset($addon['price']) ? $addon['price'] : $thisMealAddon->price,
                            ]);
                    } else {
                        $checkAddon = Addon::whereId($addon['id'])
                            ->where('restaurant_id', $restaurant_id)
                            ->first();
                        if ($checkAddon) {
                            MealAddon::create([
                                'restaurant_id' => $restaurant_id,
                                'meal_id' => $meal->id,
                                'addon_id' => $addon['id'],
                                'active' => isset($addon['active']) ? $addon['active'] : 1,
                                'price' => isset($addon['price']) ? $addon['price'] : 0,
                            ]);
                        }
                    }
                }
                ////////
            }
        }

        return $this->sendSuccess(__('lang.updated_s'), 201);
    }

    public function destroy(MealDestroyRequest $request)
    {
        $data = $request->validated();
        Meal::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->delete();
        return $this->sendSuccess(__('lang.deleted_s'), 201);
    }

    public function deleteItem(DeleteItemMealRequest $request)
    {
//        dd(request()->type);
//        $request = $request->validated();

        if (request()->type == "addon") {
            MealAddon::whereId(request()->id)
//                ->where('meal_id',request()->meal_id)
                ->delete();
        } elseif (request()->type == "attribute") {
            MealAttribute::whereId(request()->id)
                ->where('restaurant_id', restaurant()->id)
//                ->where('meal_id',request()->meal_id)
                ->delete();
        } elseif (request()->type == "option") {
            MealAttributeOption::where(request()->id)
//                ->where('meal_id',request()->meal_id)
                ->delete();
        } else {
            return $this->sendError("error");
        }
        return $this->sendSuccess(__('lang.deleted_s'), 201);
    }

    public function addItem(AddItemMealRequest $request)
    {
        $data = $request->validated();

        $restaurant_id = restaurant()->id;
        $meal_id = $request->meal_id;

        //--add addon to exist meal
        if ($request->type == "addon") {
            $checkAddon = Addon::whereId($request->id)
                ->where('restaurant_id', $restaurant_id)
                ->first();
            if ($checkAddon) {
                MealAddon::create([
                    'restaurant_id' => $restaurant_id,
                    'meal_id' => $meal_id,
                    'addon_id' => $request->id,
                    'active' => $request->active,
                    'price' => $request->price,
                ]);
            }
        }
        //--end

        //--add attribute to exist meal
        if ($request->type == "attribute") {
            $checkAttribute = Attribute::whereId($request->id)
                ->where('restaurant_id', $restaurant_id)
                ->first();
            if ($checkAttribute) {
                MealAttribute::create([
                    'restaurant_id' => $restaurant_id,
                    'meal_id' => $meal_id,
                    'attribute_id' => $request->id,
                    'active' => $request->active,
                ]);
            }
        }
        //--end

        //--add option to exist attribute to exist meal
        if ($request->type == "option") {
            $thisMealAttributeOption = Option::where('attribute_id', $request->attribute_id)
                ->where('restaurant_id', $restaurant_id)
                ->first();
            if ($thisMealAttributeOption) {
                $thisMealAttribute = MealAttribute::where('attribute_id', $request->attribute_id)
                    ->where('restaurant_id', $restaurant_id)
                    ->where('meal_id', $request->meal_id)
                    ->first();
                if ($thisMealAttribute) {
                    MealAttributeOption::create([
                        'restaurant_id' => $restaurant_id,
                        'meal_id' => $request->meal_id,
                        'meal_attribute_id' => $thisMealAttribute->id,
                        'option_id' => $request->id,
                        'active' => $request->active,
                        'price' => $request->price,
                    ]);
                }
            }
        }
        //--end
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function search(SearchMealRequest $request)
    {
        $request->validated();

        $posts = Meal::where('restaurant_id', restaurant()->id)
            ->where('name_ar', 'like', '%' . request()->search_key . '%')
            ->orWhere('name_en', 'like', '%' . request()->search_key . '%')
            ->orWhere('desc_ar', 'like', '%' . request()->search_key . '%')
            ->orWhere('desc_en', 'like', '%' . request()->search_key . '%')
            ->paginate(pagination_number());
        $data = (MealResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function filter(FilterMealRequest $request)
    {
        $request->validated();

        $status = request()->status;
        $price = request()->price;

        $results = Meal::where('restaurant_id', restaurant()->id)
            ->where(function ($q) use ($status, $price) {
                if (isset($status)) {
//                    'pending', 'accepted', 'rejected'
                    $q->where('status', $status);
                }
                if (isset($price)) {
                    $q->where('price', 'like', '%' . request()->price . '%');
                }
            })->paginate(pagination_number());

        $data = (MealResources::collection($results))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

}
