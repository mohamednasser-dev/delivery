<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerLocationsResources extends JsonResource
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
            'main'=>(int)$this->main,
            'title'=>(string)$this->title,
            'lat'=>(string)$this->lat,
            'lng'=>(string)$this->lng,
            'address'=>(string)$this->address,
        ];
    }
}
