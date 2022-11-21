<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResources extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'name'=>$this->name,
            'name_ar'=>$this->name_ar,
            'name_en'=>$this->name_en,
            'crn'=>$this->crn,
            'notification'=>(int)$this->notification,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'address'=> !empty($this->address) ? $this->address : "",
            'full_name'=>$this->full_name,
            'created_at'=>$this->created_at->diffForHumans(),
            'nationally'=>new NationalityResources($this->nationality),
            'owner_type'=>new OwnerTypeResources($this->owner_type),
            'restaurant_type'=>new RestaurantTypeResources($this->type) ,
        ];
    }
}
