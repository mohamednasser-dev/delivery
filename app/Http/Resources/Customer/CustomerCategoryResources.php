<?php

namespace App\Http\Resources\Custommer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerCategoryResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = request()->header('lang');
        return
        [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $lang == 'en' ? $this->name_en : $this->name_ar ,
        ];
    }
}
