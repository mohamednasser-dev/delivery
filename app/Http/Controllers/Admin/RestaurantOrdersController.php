<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AddonsDashboardRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MealsDashboardRequest;
use App\Http\Requests\Admin\RestaurantSettingsDashboardRequest;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Meal;
use App\Models\MealAddon;
use App\Models\MealAttribute;
use App\Models\MealAttributeOption;
use App\Models\Option;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Exception;


class RestaurantOrdersController extends Controller
{
    protected $viewPath = 'admin.restaurants.dashboard.';
    private $route = 'orders';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Order $model)
    {
        $this->objectName = $model;
    }

    public function index($id,$status = null)
    {
        $data = Restaurant::findOrFail($id);
        $type = 'orders';
        $allOrders = $this->objectName::where('restaurant_id', $id)->select('id')->get();
        $incomingOrders = $this->objectName::where('restaurant_id', $id)
            ->whereNull('on_processing')->whereNull('on_delivery')
            ->whereNull('delivered_at')->whereNull('cancelled_at')
            ->whereNull('cancelled_by')->select('id')->get();
        $on_processingOrders = $this->objectName::where('restaurant_id', $id)
            ->whereNotNull('on_processing')->whereNull('on_delivery')
            ->whereNull('delivered_at')->whereNull('cancelled_at')
            ->whereNull('cancelled_by')->select('id')->get();
        $on_deliveryOrders = $this->objectName::where('restaurant_id', $id)
            ->whereNotNull('on_processing')->whereNotNull('on_delivery')
            ->whereNull('delivered_at')->whereNull('cancelled_at')
            ->whereNull('cancelled_by')->select('id')->get();
        $deliveredOrders = $this->objectName::where('restaurant_id', $id)
            ->whereNotNull('on_processing')->whereNotNull('on_delivery')
            ->whereNotNull('delivered_at')->whereNull('cancelled_at')
            ->whereNull('cancelled_by')->select('id')->get();
        $deliveredOrders = $this->objectName::where('restaurant_id', $id)
            ->whereNotNull('cancelled_at')->whereNotNull('cancelled_by')
            ->select('id')->get();

        $meals = $this->objectName::where('restaurant_id', $id)
            ->where(function ($q) use ($status){
                if($status == "incoming"){
                    $q->whereNull('on_processing')
                        ->whereNull('on_delivery')
                        ->whereNull('delivered_at')
                        ->whereNull('cancelled_at')
                        ->whereNull('cancelled_by');
                } elseif($status == "on_processing"){
                    $q->whereNotNull('on_processing')
                        ->whereNull('on_delivery')
                        ->whereNull('delivered_at')
                        ->whereNull('cancelled_at')
                        ->whereNull('cancelled_by');
                } elseif($status == "on_delivery"){
                    $q->whereNotNull('on_processing')
                        ->whereNotNull('on_delivery')
                        ->whereNull('delivered_at')
                        ->whereNull('cancelled_at')
                        ->whereNull('cancelled_by');
                } elseif($status == "delivered"){
                    $q->whereNotNull('on_processing')
                        ->whereNotNull('on_delivery')
                        ->whereNotNull('delivered_at')
                        ->whereNull('cancelled_at')
                        ->whereNull('cancelled_by');
                } elseif($status == "cancelled"){
                    $q->whereNotNull('cancelled_at')
                        ->whereNotNull('cancelled_by');
                }
            })->orderBy('created_at','desc')->get();
        return view($this->viewPath . 'index', compact('data', 'type','meals','status',
        'allOrders','incomingOrders','on_processingOrders','on_deliveryOrders','deliveredOrders','deliveredOrders'));
    }
}
