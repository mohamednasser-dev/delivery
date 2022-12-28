<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerMealAttributesResources extends JsonResource
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
            'name'=>(string)$this->attribute->name,
            'min_choice'=>(int)$this->min_choice,
            'max_choice'=>(int)$this->max_choice,
            'options'=>CustomerAttributesOptionsResources::collection($this->meal_attribute_options),
        ];
    }
}
