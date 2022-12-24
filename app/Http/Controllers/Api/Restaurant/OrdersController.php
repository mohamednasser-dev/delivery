<?php

namespace App\Http\Controllers\Api\Restaurant;


use App\Http\Requests\Restaurant\Order\FilterOrderRequest;
use App\Http\Requests\Restaurant\Order\SearchOrderRequest;
use App\Http\Resources\OrderDetailsResources;
use App\Http\Resources\OrderResources;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

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

    public function search(SearchOrderRequest $request)
    {
        $request->validated();

        $results = Order::where('restaurant_id', restaurant()->id)
            ->where('order_num', 'like', '%' . request()->search_key . '%')
            ->paginate(pagination_number());

        $data = (OrderResources::collection($results))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function filter(FilterOrderRequest $request)
    {
        $request->validated();

        $date_from = Carbon::parse(request()->date_from)->format('Y-m-d');
        $date_to = Carbon::parse(request()->date_to)->format('Y-m-d');
        $time_from = Carbon::parse(request()->time_from)->format('H:i');
        $time_to = Carbon::parse(request()->time_to)->format('H:i');
        $status = request()->status;

        $results = Order::where('restaurant_id', restaurant()->id)
            ->where(function ($q) use ($date_from,$date_to,$time_from,$time_to,$status){
                if(isset($date_from) && isset($date_to) && isset($time_from) && isset($time_to)){

                    $from = $date_from . ' ' . $time_from;
                    $to = $date_to . ' ' . $time_to;
                    $q->whereBetween('created_at', [$from, $to]);
                }elseif (isset($date_from) && isset($date_to) && (!isset($time_from) || !isset($time_to)) ){

                    $q->whereBetween('created_at', [$date_from, $date_to]);
                }elseif (isset($time_from) && isset($time_to) && (!isset($date_from) || !isset($date_to))){

                    $from = Carbon::now()->format('Y-m-d') . ' ' . $time_from;
                    $to = Carbon::now()->format('Y-m-d')  . ' ' . $time_to;
                    $q->whereBetween('created_at', [$from, $to]);
                }
                if (isset($status) && !empty($status)){

                    if($status == "incoming"){
                        $q->whereNull('on_processing')
                            ->whereNull('on_delivery')
                            ->whereNull('delivered_at')
                            ->whereNull('cancelled_at')
                            ->whereNull('cancelled_by');
                    }
                    elseif($status == "on_processing"){
                        $q->whereNotNull('on_processing')
                            ->whereNull('on_delivery')
                            ->whereNull('delivered_at')
                            ->whereNull('cancelled_at')
                            ->whereNull('cancelled_by');
                    }
                    elseif($status == "on_delivery"){
                        $q->whereNotNull('on_processing')
                            ->whereNotNull('on_delivery')
                            ->whereNull('delivered_at')
                            ->whereNull('cancelled_at')
                            ->whereNull('cancelled_by');
                    }
                    elseif($status == "delivered"){
                        $q->whereNotNull('on_processing')
                            ->whereNotNull('on_delivery')
                            ->whereNotNull('delivered_at')
                            ->whereNull('cancelled_at')
                            ->whereNull('cancelled_by');
                    }
                    elseif($status == "cancelled"){
                        $q->whereNotNull('cancelled_at')
                            ->whereNotNull('cancelled_by');
                    }
                }
            })->paginate(pagination_number());

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
                ->whereNull('delivered_at')
                ->update(['delivered_at' => Carbon::now()]);
        }
        if($type == "cancelled"){
            Order::whereId($order_id)
                ->where('restaurant_id', $restaurant_id)
                ->whereNull('cancelled_at')
                ->update([
                    'cancelled_at' => Carbon::now(),
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
