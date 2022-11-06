<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Requests\Restaurant\Meal\AddItemMealRequest;
use App\Http\Requests\Restaurant\Meal\DeleteItemMealRequest;
use App\Http\Requests\Restaurant\Meal\MealDestroyRequest;
use App\Http\Requests\Restaurant\Meal\MealRequest;
use App\Http\Resources\MealResources;
use App\Http\Resources\OrderDetailsResources;
use App\Http\Resources\OrderResources;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Models\MealAddon;
use App\Models\MealAttribute;
use App\Models\MealAttributeOption;
use App\Models\Option;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{

    public function getOrdersByType($type)
    {
        $results = [];
        if($type == "incoming"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNull('on_pocessing')
                ->whereNull('on_delivery')
                ->whereNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        if($type == "on_pocessing"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('on_pocessing')
                ->whereNull('on_delivery')
                ->whereNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        if($type == "on_delivery"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('on_pocessing')
                ->whereNotNull('on_delivery')
                ->whereNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        if($type == "delivered"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('on_pocessing')
                ->whereNotNull('on_delivery')
                ->whereNotNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        if($type == "cancelled"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('cancelled_at')
                ->whereNotNull('cancelled_by')
                ->paginate(pagination_number());
        }
        $data = (OrderResources::collection($results))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function updateStatus()
    {
        $restaurant_id = restaurant()->id;
        $type = request()->type;
        $order_id = request()->order_id;
        if($type == "on_pocessing"){
            Order::whereId($order_id)
                ->where('restaurant_id', $restaurant_id)
                ->whereNull('on_pocessing')
                ->update(['on_pocessing' => Carbon::now()]);
        }
        if($type == "on_delivery"){
            Order::whereId($order_id)
                ->where('restaurant_id', $restaurant_id)
                ->whereNull('on_delivery')
                ->update(['on_delivery' => Carbon::now()]);
        }
        if($type == "delivered"){
            Order::whereId($order_id)
                ->where('restaurant_id', $restaurant_id)
                ->whereNull('delivered')
                ->update(['delivered' => Carbon::now()]);
        }
        if($type == "cancelled"){
            Order::whereId($order_id)
                ->where('restaurant_id', $restaurant_id)
                ->whereNull('cancelled')
                ->update([
                    'cancelled' => Carbon::now(),
                    'cancelled_by' => "restaurant",
                    'cancele_reason' => request()->cancele_reason,
                ]);
        }
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function orderDetails()
    {
        $restaurant_id = restaurant()->id;
        $order_id = request()->order_id;

        $results = Order::whereId($order_id)
            ->where('restaurant_id', $restaurant_id)
            ->first();

        $data = (new OrderDetailsResources($results))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }



}
