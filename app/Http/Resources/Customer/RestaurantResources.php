<?php

namespace App\Http\Resources\Customer;

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
            'cover'=>$this->cover,
            'rate' => number_format((float)($this->rating), 1),
            'name'=> $this->name ,
            'description'=> $this->description,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'address'=> !empty($this->address) ? $this->address : "",
        ];
    }
}
