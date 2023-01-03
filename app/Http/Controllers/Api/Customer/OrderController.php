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
//        Order::create([
//
//        ]);
    }
}
