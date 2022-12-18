<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantTypeRequest;
use App\Mail\RestaurantPasswordMail;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Nationality;
use App\Models\OwnerType;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Models\Section;
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
        $data = $this->objectName::findOrFail($id);
        if ($type == 'info') {
            $restaurant_types = RestaurantType::get();
            $nationalities = Nationality::get();
            $owner_types = OwnerType::get();
            $sections = Section::orderBy('created_at','asc')->get();
            $sections_ids = $data->sections->pluck('section_id')->toArray();
            return view($this->viewPath . 'index', compact('sections_ids','data', 'type', 'restaurant_types', 'nationalities','owner_types','sections'));
        } else {
            return view($this->viewPath . 'index', compact('data', 'type'));
        }
    }


}
