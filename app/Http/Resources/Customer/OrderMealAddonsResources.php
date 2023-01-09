<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderMealAddonsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = request()->header('lang');

        return [
            'id'=>$this->id,
            'meal_id'=>$this->meal_id,
            'order_meal_id'=>$this->order_meal_id,
            'order_meal_attribute_id'=>$this->order_meal_attribute_id,
            'addon_id'=>$this->addon_id,
            'name'=> $this->name,
            'qty'=> $this->qty,
            'price' => isset($this->price) ? $this->price : 0,
            'total_price' => isset($this->total_price) ? $this->total_price : 0,
        ];
    }
}
