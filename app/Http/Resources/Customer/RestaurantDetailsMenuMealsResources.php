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
        $lang = request()->header('lang');
        return [
            'id'=>$this->id,
            'logo'=>$this->logo,
            'cover'=>$this->cover,
            'rate' => (double)4.0,
            'name'=> $lang == 'en' ? $this->name_en : $this->name_ar,
            //TODO
            'description'=> $lang == 'en' ? "وصف" : "description",
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'address'=> !empty($this->address) ? $this->address : "",
            'categories'=>$this->categories->load(['acceptedActiveMeals']),
        ];
    }
}
