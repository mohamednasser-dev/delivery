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


class RestaurantTransactionsController extends Controller
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
        $type = 'transactions';
        return view($this->viewPath . 'index', compact('data', 'type'));

    }

}
