<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = [
            'id'=>(int) 0,
            'name'=> request()->header('lang') == 'ar' ? 'الكل' : 'All',
            'image'=> '',
        ];
        $data = [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$this->image,
        ];
        return array_merge($arr,$data);
    }
}
