<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CopounResources extends JsonResource
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
            'from_date'=>$this->from_date,
            'to_date'=>$this->to_date,
            'code'=> $this->code,
            'type'=>$this->type,
            'amount'=>$this->amount,
            'description'=> isset($this->description) ? $this->description : "",
        ];
    }
}
