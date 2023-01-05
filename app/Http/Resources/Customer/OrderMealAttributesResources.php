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
        $lang = request()->header('lang');

        return [
            'id'=>$this->id,
            'meal_id'=>$this->meal_id,
            'order_meal_id'=>$this->order_meal_id,
            'attribute_id'=>$this->attribute_id,
            'name'=> $lang == 'en' ? $this->name_en : $this->name_ar,
            'meal_attribute_options'=>isset($this->orderMealAttributeOptions) ? (OrderMealAttributeOptionsResources::collection($this->orderMealAttributeOptions)) : [],
        ];
    }
}
