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
            'name'=>$this->name,
            'name_ar'=>$this->name_ar,
            'name_en'=>$this->name_en,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'address'=> !empty($this->address) ? $this->address : "",
            'full_name'=>$this->full_name,
            'categories'=>$this->categories->load('acceptedActiveMeals as meals'),
        ];
    }
}
