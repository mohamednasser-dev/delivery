<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantMealsOfCategoryResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'image' => $this->image,
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
            ];
    }
}
