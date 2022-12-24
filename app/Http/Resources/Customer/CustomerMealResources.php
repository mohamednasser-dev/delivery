<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerMealResources extends JsonResource
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
                'category' => $this->category->name,
                'price' => $this->price,
                'description' => $this->description,
                'meal_attributes' =>  CustomerMealAttributesResources::collection($this->meal_attributes),
                'meal_addons' => CustomerMealAddonsResources::collection($this->meal_addons),

            ];
    }
}
