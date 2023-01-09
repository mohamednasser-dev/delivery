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
        return
            [
                'id' => $this->id,
                'image' => $this->image,
                'name'=>  $this->name,
//                'meals'=> isset($this->acceptedActiveMeals) ? (RestaurantMealsOfCategoryResources::collection($this->acceptedActiveMeals)) : null,
            ];
    }
}
