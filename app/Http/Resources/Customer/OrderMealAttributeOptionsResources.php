<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderMealAttributeOptionsResources extends JsonResource
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
            'meal_attribute_id'=>$this->meal_attribute_id,
            'order_meal_attribute_id'=>$this->order_meal_attribute_id,
            'option_id'=>$this->option_id,
            'name'=>  $this->name,
            'qty'=> $this->qty,
            'price' => isset($this->price) ? $this->price : 0,
            'total_price' => isset($this->total_price) ? $this->total_price : 0,
        ];
    }
}
