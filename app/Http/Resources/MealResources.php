<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResources extends JsonResource
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
                'image' => $this->image,
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
                'active' => $this->active,
                'price' => $this->price,
                'desc_ar' => $this->desc_ar,
                'desc_en' => $this->desc_en,
                'status' => $this->status,
                'position' => $this->position,


                'attributes' => $this->load(['meal_attributes' => function($q){ $q->with('meal_attribute_options'); }]),
                'addons' => $this->load('meal_addons'),

            ];
    }
}
