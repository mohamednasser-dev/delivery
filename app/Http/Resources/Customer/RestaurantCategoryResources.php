<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantCategoryResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //represent Category Model
        $lang = request()->header('lang');
        return
            [
                'id' => $this->id,
                'image' => $this->image,
                'name'=> $lang == 'en' ? $this->name_en : $this->name_ar,
//                'meals'=> isset($this->acceptedActiveMeals) ? (RestaurantMealsOfCategoryResources::collection($this->acceptedActiveMeals)) : null,
            ];
    }
}
