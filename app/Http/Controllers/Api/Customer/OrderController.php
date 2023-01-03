<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\RestaurantResources;
use App\Http\Resources\Customer\SectionResources;
use App\Http\Resources\Customer\OfferResources;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RestaurantSection;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Offer;


class OrderController extends Controller
{

    public function makeOrder(Request $request)
    {
        $customer = customer();
        Order::create([
            'user_id' => $customer->id,
            'restaurant_id' => $request,
            'discount_price' => 0,
            'fee' => 0,
            'tax' => 0,
            'sub_total' => 0,
            'total_price' => 0,
            'in_lat' => 0,
            'in_lng' => 0,
            'in_location' => 0,
            'out_lat' => 0,
            'out_lng' => 0,
            'out_location' => 0,
        ]);
    }
}
