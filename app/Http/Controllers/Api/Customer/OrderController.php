<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\RestaurantResources;
use App\Http\Resources\Customer\SectionResources;
use App\Http\Resources\Customer\OfferResources;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerOrderDetailsResources;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Meal;
use App\Models\MealAddon;
use App\Models\MealAttribute;
use App\Models\MealAttributeOption;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderMeal;
use App\Models\OrderMealAddons;
use App\Models\OrderMealAttribute;
use App\Models\OrderMealAttributeOption;
use App\Models\RestaurantSection;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Offer;


class OrderController extends Controller
{

    public function store(Request $request)
    {

        if($request->meals && sizeof($request->meals) > 0){
            $customer = customer();
            global $cost;
            $cost = 0;

            //createOrder
            $order = $this->createOrder($request,$customer,$cost);

            if($order){
                foreach ($request->meals as $meal){
                    $checkMeal = Meal::whereId($meal['id'])
                        ->where('restaurant_id',$request->restaurant_id)->first();
                    if($checkMeal){

                        //createOrderMeal
                        $orderMeal = $this->createOrderMeal($order,$checkMeal,$meal);
                        $cost = $orderMeal->total_price;

                        if($orderMeal && isset($meal['attributess']) && sizeof($meal['attributess'])>0){
                            foreach ($meal['attributess'] as $attr){
                                $checkAttribute = Attribute::whereId($attr['id'])
                                    ->where('restaurant_id', $checkMeal->restaurant_id)
                                    ->first();
                                $checkMealAttribute = MealAttribute::where('attribute_id',$attr['id'])
                                    ->where('restaurant_id', $checkMeal->restaurant_id)
                                    ->where('meal_id', $checkMeal->id)
                                    ->first();
                                if($checkAttribute && $checkMealAttribute){

                                    //createOrderMealAttribute
                                    $OrderMealAttribute = $this->createOrderMealAttribute($order,$orderMeal,$checkMeal,$checkAttribute);

                                    if($OrderMealAttribute && isset($attr['options']) && sizeof($attr['options'])>0){
                                        foreach ($attr['options'] as $attrOption){
                                            $checkOption = Option::whereId($attrOption['id'])
                                                ->where('restaurant_id', $checkMeal->restaurant_id)
                                                ->first();
                                            $checkMealAttributeOption = MealAttributeOption::where('option_id',$attrOption['id'])
                                                ->where('meal_id', $checkMeal->id)
                                                ->where('meal_attribute_id', $checkMealAttribute->id)
                                                ->first();
                                            if ($checkOption && $checkMealAttributeOption) {

                                                //createOrderMealAttributeOption
                                                $OrderMealAttributeOption = $this->createOrderMealAttributeOption($order,$checkMeal,$OrderMealAttribute,$checkOption,$checkMealAttributeOption,$attrOption);
                                                $cost = $cost + $OrderMealAttributeOption->total_price;

                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if($orderMeal && isset($meal['addons']) && sizeof($meal['addons'])>0){
                            foreach ($meal['addons'] as $addon){
                                $checkAddon = Addon::whereId($addon['id'])
                                    ->where('restaurant_id', $checkMeal->restaurant_id)
                                    ->first();
                                $checkMealAddon = MealAddon::where('addon_id',$addon['id'])
                                    ->where('meal_id', $checkMeal->id)
                                    ->first();
                                if($checkAddon && $checkMealAddon){

                                    //createOrderMealAddons
                                    $OrderMealAddons = $this->createOrderMealAddons($order,$checkMeal,$orderMeal,$checkAddon,$checkMealAddon,$addon);
                                    $cost = $cost + $OrderMealAddons->total_price;

                                }

                            }
                        }
                    }

                }

            }
        }
        Order::whereId($order->id)->update([
            'sub_total' => $cost,
            'total_price' => $cost,
        ]);
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function getOrderDetails(){
        $customer_id = customer()->id;
        $order_id = request()->order_id;

        $results = Order::whereId($order_id)
            ->where('user_id', $customer_id)
            ->first();

        $data = (new CustomerOrderDetailsResources($results))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function createOrder($request,$customer,$cost){
        return Order::create([
            'order_num' => time().'_'.$customer->id,
            'payment_type' => isset($request->payment_type) ? $request->payment_type : "cash" ,
            'user_id' => $customer->id,
            'restaurant_id' => $request->restaurant_id,
            'discount_price' => 0,
            'fee' => 0,
            'tax' => 0,
            'sub_total' => $cost,
            'total_price' => $cost,
            'in_lat' => $request->in_lat,
            'in_lng' => $request->in_lng,
            'in_location' => $request->in_location,
            'out_lat' => $request->out_lat,
            'out_lng' => $request->out_lng,
            'out_location' => $request->out_location,
        ]);
    }

    public function createOrderMeal($order,$checkMeal,$meal){
        return OrderMeal::create([
            'order_id' => $order->id,
            'meal_id' => $checkMeal->id,
            'restaurant_id' => $checkMeal->restaurant_id,
            'name_ar' => $checkMeal->name_ar,
            'name_en' => $checkMeal->name_en,
            'desc_ar' => $checkMeal->desc_ar,
            'desc_en' => $checkMeal->desc_en,
            'qty' => $meal['qty'],
            'price' => $checkMeal->price,
            'total_price' => $checkMeal->price * $meal['qty'],
        ]);
    }

    public function createOrderMealAttribute($order,$orderMeal,$checkMeal,$checkAttribute){
        return OrderMealAttribute::create([
            'order_id' => $order->id,
            'meal_id' => $checkMeal->id,
            'order_meal_id' => $orderMeal->id,
            'restaurant_id' => $checkMeal->restaurant_id,
            'attribute_id' => $checkAttribute->id,
            'name_ar' => $checkAttribute->name_ar,
            'name_en' => $checkAttribute->name_en,
        ]);
    }

    public function createOrderMealAttributeOption($order,$checkMeal,$OrderMealAttribute,$checkOption,$checkMealAttributeOption,$attrOption){
        return OrderMealAttributeOption::create([
            'order_id' => $order->id,
            'restaurant_id' => $checkMeal->restaurant_id,
            'meal_id' => $checkMeal->id,
            'meal_attribute_id' => $checkMealAttributeOption->meal_attribute_id,
            'order_meal_attribute_id' => $OrderMealAttribute->id,
            'option_id' => $checkOption->id,
            'name_ar' => $checkOption->name_ar,
            'name_en' => $checkOption->name_en,
            'qty' => $attrOption['qty'],
            'price' => $checkMealAttributeOption->price,
            'total_price' => $checkMealAttributeOption->price * $attrOption['qty'],
        ]);
    }

    public function createOrderMealAddons($order,$checkMeal,$orderMeal,$checkAddon,$checkMealAddon,$addon){
        return OrderMealAddons::create([
            'order_id' => $order->id,
            'meal_id' => $checkMeal->id,
            'order_meal_id' => $orderMeal->id,
            'restaurant_id' => $checkMeal->restaurant_id,
            'addon_id' => $checkAddon->id,
            'name_ar' => $checkAddon->name_ar,
            'name_en' => $checkAddon->name_en,
            'qty' => $addon['qty'],
            'price' => $checkMealAddon->price,
            'total_price' => $checkMealAddon->price * $addon['qty'],
        ]);
    }
}
