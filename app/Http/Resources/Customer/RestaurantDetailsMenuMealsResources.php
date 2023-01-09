<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantDetailsMenuMealsResources extends JsonResource
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
            'logo'=>$this->logo,
            'cover'=>$this->cover,
            'rate' => (double)4.0,
            'name'=> $this->name,
            //TODO
            'description'=> $this->description,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'address'=> !empty($this->address) ? $this->address : "",
            'categories'=> isset($this->categories) ? (RestaurantCategoryResources::collection($this->categories)) : null,
        ];
    }
}
