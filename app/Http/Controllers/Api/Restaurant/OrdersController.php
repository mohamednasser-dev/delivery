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

    public function getOrdersByType($type = null)
    {
        $results = [];
        if($type == "incoming"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNull('on_processing')
                ->whereNull('on_delivery')
                ->whereNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        elseif($type == "on_processing"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('on_processing')
                ->whereNull('on_delivery')
                ->whereNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        elseif($type == "on_delivery"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('on_processing')
                ->whereNotNull('on_delivery')
                ->whereNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        elseif($type == "delivered"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('on_processing')
                ->whereNotNull('on_delivery')
                ->whereNotNull('delivered_at')
                ->whereNull('cancelled_at')
                ->whereNull('cancelled_by')
                ->paginate(pagination_number());
        }
        elseif($type == "cancelled"){
            $results = Order::where('restaurant_id', restaurant()->id)
                ->whereNotNull('cancelled_at')
                ->whereNotNull('cancelled_by')
                ->paginate(pagination_number());
        }
        else{
            $results = Order::where('restaurant_id', restaurant()->id)
                ->paginate(pagination_number());
        }
        $data = (OrderResources::collection($results))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function search()
    {
        $results = Order::where('restaurant_id', restaurant()->id)
            ->where('order_num', 'like', '%' . request()->search_key . '%')
            ->paginate(pagination_number());

        $data = (OrderResources::collection($results))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function updateStatus()
    {
        $restaurant_id = restaurant()->id;
        $type = request()->type;
        $order_id = request()->order_id;
        if($type == "on_processing"){
            Order::whereId($order_id)
                ->where('restaurant_id', $restaurant_id)
                ->whereNull('on_processing')
                ->update(['on_processing' => Carbon::now()]);
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
