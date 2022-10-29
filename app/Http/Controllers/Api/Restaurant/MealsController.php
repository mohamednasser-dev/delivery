<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Requests\Restaurant\Meal\MealDestroyRequest;
use App\Http\Requests\Restaurant\Meal\MealRequest;
use App\Http\Resources\MealResources;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Models\MealAddon;
use App\Models\MealAttribute;
use App\Models\MealAttributeOption;
use App\Models\Option;

class MealsController extends Controller
{

    public function index()
    {
        $posts = Meal::where('restaurant_id', restaurant()->id)->paginate(pagination_number());
        $data = (MealResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function store(MealRequest $request)
    {
//        dd($request->attributess['id']);
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
        if($meal && isset($request->attributess)){
            $checkAttribute = Attribute::whereId($request->attributess['id'])
                ->where('restaurant_id',$restaurant_id)
                ->first();
            if($checkAttribute){
                $mealAttribute = MealAttribute::create([
                    'restaurant_id' => $restaurant_id,
                    'meal_id' => $meal->id,
                    'attribute_id' => $request->attributess['id'],
                    'active' => $request->attributess['id'],
                ]);
                if($mealAttribute && isset($request->attributess['options'])){
                    $checkOption = Option::whereId($request->attributess['options']['id'])
                        ->where('restaurant_id',$restaurant_id)
                        ->first();
                    if($checkOption){
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
        if($meal && isset($request->addons)){
            foreach ($request->addons as $addon){
                $checkAddon = Addon::whereId($addon['id'])
                    ->where('restaurant_id',$restaurant_id)
                    ->first();
                if($checkAddon){
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
        Meal::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->update($data);
        return $this->sendSuccess(__('lang.updated_s'), 201);
    }

    public function destroy(MealDestroyRequest $request)
    {
        $data = $request->validated();
        Meal::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->delete();
        return $this->sendSuccess(__('lang.deleted_s'), 201);
    }


}
