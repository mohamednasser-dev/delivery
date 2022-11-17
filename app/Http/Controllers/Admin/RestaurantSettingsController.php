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
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Exception;


class RestaurantSettingsController extends Controller
{
    protected $viewPath = 'admin.restaurants.dashboard.';
    private $route = 'meals';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Restaurant $model)
    {
        $this->objectName = $model;
    }

    public function index($id)
    {
        $data = $this->objectName::findOrFail($id);
        $type = 'settings';
        return view($this->viewPath . 'index', compact('data', 'type'));

    }

    public function update(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'id' => 'required|exists:restaurants,id',
                'is_active' => 'nullable',
                'commission' => 'required|numeric|min:0',
                'min_order_price' => 'required|numeric|min:0',
                'tax' => 'required|numeric|min:0',
                'free_delivery' => 'nullable',
                'min_shipping_charge' => 'required|numeric|min:0',
                'min_delivery_time' => 'required|numeric|min:0',
                'max_delivery_time' => 'required|numeric|min:0',
            ]);

        //is_active

        if ($request->is_active) {
            $data['is_active'] = 1;
        } else {
            $data['is_active'] = 0;
        }
        //free_delivery
        if ($request->free_delivery) {
            $data['free_delivery'] = 1;
        } else {
            $data['free_delivery'] = 0;
        }
        $this->objectName::findOrFail($data['id'])->update($data);
        session()->flash('success', trans('lang.updatSuccess'));
        return redirect()->back();
    }


}
