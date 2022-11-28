<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResources extends JsonResource
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
                'on_processing' => isset($this->on_processing) ? $this->on_processing : "",
                'on_delivery' => isset($this->on_delivery) ? $this->on_delivery : "",
                'delivered_at' => isset($this->delivered_at) ? $this->delivered_at : "",
                'cancelled_at' => isset($this->cancelled_at) ? $this->cancelled_at : "",
                'cancelled_by' => isset($this->cancelled_by) ? $this->cancelled_by : "",
                'cancele_reason' => isset($this->cancele_reason) ? $this->cancele_reason : "",
                'discount_price' => isset($this->discount_price) ? $this->discount_price : "",
                'fee' => isset($this->fee) ? $this->fee : "0",
                'tax' => isset($this->tax) ? $this->tax : "0",
                'sub_total' => isset($this->sub_total) ? $this->sub_total : "0",
                'total_price' => isset($this->total_price) ? $this->total_price : "0",
                'in_lat' => isset($this->in_lat) ? $this->in_lat : "",
                'in_lng' => isset($this->in_lng) ? $this->in_lng : "",
                'in_location' => isset($this->in_location) ? $this->in_location : "",
                'out_lat' => isset($this->out_lat) ? $this->out_lat : "",
                'out_lng' => isset($this->out_lng) ? $this->out_lng : "",
                'out_location' => isset($this->out_location) ? $this->out_location : "",
                'created_at' => $this->created_at,
                'no_of_items' => isset($this->orderMeals) ? count($this->orderMeals) : 0,
                'user' => $this->user,
            ];
    }
}
