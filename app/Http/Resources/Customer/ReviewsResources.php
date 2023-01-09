<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'customer_name' => $this->customer->name,
                'rate' => $this->rate,
                'comment' => $this->comment,
                'created_at' => $this->created_at->format('Y-m-d'),
            ];
    }
}
