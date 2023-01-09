<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResources extends JsonResource
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
                'restaurant_id' => $this->restaurant_id,
                'name' => $this->restaurant->name,
                'logo' => $this->restaurant->logo,
                'rating' => $this->restaurant->rating,
                'address' => $this->restaurant->address,
            ];
    }
}
