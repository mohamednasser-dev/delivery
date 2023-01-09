<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderMealAttributesResources extends JsonResource
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
            'meal_id'=>$this->meal_id,
            'order_meal_id'=>$this->order_meal_id,
            'attribute_id'=>$this->attribute_id,
            'name'=> $this->name,
            'meal_attribute_options'=>isset($this->orderMealAttributeOptions) ? (OrderMealAttributeOptionsResources::collection($this->orderMealAttributeOptions)) : [],
        ];
    }
}
