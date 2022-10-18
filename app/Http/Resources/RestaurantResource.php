<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'name'=>$this->name,
            'status'=>$this->status,
            'crn'=>$this->crn,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'full_name'=>$this->full_name,
            'created_at'=>$this->created_at->diffForHumans(),
            'nationally'=>new NationalityResource($this->nationality),
            'owner_type'=>new OwnerTypeResource($this->owner_type),
            'restaurant_type'=>new RestaurantTypeResource($this->type) ,
        ];
    }
}
