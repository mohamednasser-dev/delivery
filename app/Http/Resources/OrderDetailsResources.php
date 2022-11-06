<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResources extends JsonResource
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
                'order_num' => $this->order_num,
                'user_id' => $this->user_id,
                'restaurant_id' => $this->restaurant_id,
                'on_pocessing' => isset($this->on_pocessing) ? $this->on_pocessing : "",
                'on_delivery' => isset($this->on_delivery) ? $this->on_delivery : "",
                'delivered_at' => isset($this->delivered_at) ? $this->delivered_at : "",
                'cancelled_at' => isset($this->cancelled_at) ? $this->cancelled_at : "",
                'cancelled_by' => isset($this->cancelled_by) ? $this->cancelled_by : "",
                'cancele_reason' => isset($this->cancele_reason) ? $this->cancele_reason : "",
                'discount_price' => isset($this->discount_price) ? $this->discount_price : "",
                'total_price' => isset($this->total_price) ? $this->total_price : "0",
                'in_lat' => isset($this->in_lat) ? $this->in_lat : "",
                'in_lng' => isset($this->in_lng) ? $this->in_lng : "",
                'in_location' => isset($this->in_location) ? $this->in_location : "",
                'out_lat' => isset($this->out_lat) ? $this->out_lat : "",
                'out_lng' => isset($this->out_lng) ? $this->out_lng : "",
                'out_location' => isset($this->out_location) ? $this->out_location : "",
                'no_of_items' => isset($this->orderMeals) ? count($this->orderMeals) : 0,
                'meals' => isset($this->orderMeals) ? $this->orderMeals->load(['orderMealAttributes' => function($q){ $q->with('orderMealAttributeOptions'); }])->load(['orderMealAddons']) : (object)[],
            ];
    }
}
