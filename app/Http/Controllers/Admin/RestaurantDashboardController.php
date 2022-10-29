<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantTypeRequest;
use App\Mail\RestaurantPasswordMail;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Exception;
use Illuminate\Support\Facades\Mail;

class RestaurantDashboardController extends Controller
{
    protected $viewPath = 'admin.restaurants.dashboard.';
    private $route = 'restaurants';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Restaurant $model)
    {
        $this->objectName = $model;
    }

    public function index($id)
    {
        $data = $this->objectName::orderBy('created_at', 'desc')->findOrFail($id);
        $type = 'info';
        return view($this->viewPath . 'index', compact('data', 'type'));
    }

    public function show($id, $type)
    {
        $data = $this->objectName::orderBy('created_at', 'desc')->findOrFail($id);
        if ($type == 'categories') {
            $categories = Category::where('restaurant_id', $id)->get();
            return view($this->viewPath . 'index', compact('data', 'type', 'categories'));
        }elseif ($type == 'attributes') {
            $categories = Attribute::where('restaurant_id', $id)->get();
            return view($this->viewPath . 'index', compact('data', 'type', 'categories'));
        }elseif ($type == 'addons') {
            $categories = Addon::where('restaurant_id', $id)->get();
            return view($this->viewPath . 'index', compact('data', 'type', 'categories'));
        }elseif ($type == 'meals') {
            $category_data = Category::where('restaurant_id', $id)->get();

            $categories = Meal::where('restaurant_id', $id)->get();
            return view($this->viewPath . 'index', compact('data', 'type', 'categories','category_data'));
        }  else {
            return view($this->viewPath . 'index', compact('data', 'type'));

        }
    }


}
