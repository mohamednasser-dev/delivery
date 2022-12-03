<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResources extends JsonResource
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
            'image'=>$this->image,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'name'=>$this->name,
            'notification'=>(int)$this->notification,
            'fcm_token'=>(string)$this->fcm_token,
            'created_at'=>$this->created_at->diffForHumans(),
        ];
    }
}
