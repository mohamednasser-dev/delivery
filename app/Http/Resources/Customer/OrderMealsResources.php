<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderMealsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'=>$this->id,
            'order_id'=>$this->order_id,
            'meal_id'=>$this->meal_id,
            'restaurant_id'=>$this->restaurant_id,
            'name'=> $this->name,
            'description'=> $this->description,
            'qty'=>(int)$this->qty,
            'price' => isset($this->price) ? $this->price : 0,
            'total_price' => isset($this->total_price) ? $this->total_price : 0,
            'image'=>$this->image,
            'meal_attributes'=>isset($this->orderMealAttributes) ? (OrderMealAttributesResources::collection($this->orderMealAttributes)) : [],
            'meal_addons'=>isset($this->orderMealAddons) ? (OrderMealAddonsResources::collection($this->orderMealAddons)) : [],
        ];
    }
}
