<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AddonsDashboardRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MealsDashboardRequest;
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


class MealsController extends Controller
{
    protected $viewPath = 'admin.restaurants.dashboard.';
    private $route = 'meals';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Meal $model)
    {
        $this->objectName = $model;
    }

    public function index(Request $request, $id)
    {
        $data = Restaurant::findOrFail($id);
        $category_data = Category::where('restaurant_id', $id)->orderBy('created_at', 'asc')->get();
        $first_cat = Category::where('restaurant_id', $id)->orderBy('created_at', 'asc')->first()->id;
        $attribute_data = Attribute::where('restaurant_id', $id)->get();
        $addons_data = Addon::where('restaurant_id', $id)->get();
        $meals = $this->objectName::when($request->category_id, function ($q) use ($request) {
            // if
            $q->where('category_id', $request->category_id);
        }, function ($q) use ($first_cat) {
            // Else, count greater or equal to 3
            $q->where('category_id', $first_cat);

        })->where('restaurant_id', $id)->get();
        $type = 'meals';
        if ($request->category_id) {
            $category_id = $request->category_id;
        } else {
            $category_id = $first_cat;
        }
        return view($this->viewPath . 'index', compact('data', 'category_id', 'type', 'meals', 'category_data', 'attribute_data', 'addons_data'));

    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

//MealsDashboardRequest
    public function store(Request $request, $id)
    {
//        dd($request->all());
        $data = $request->all();
        $data['restaurant_id'] = $id;
        $meal = $this->objectName::create($data);
        if ($meal) {
            //Begin attributes

            if (count($data['attributes']) > 0) {
                foreach ($data['attributes'] as $attr) {
                    $meal_attr_data['restaurant_id'] = $id;
                    $meal_attr_data['meal_id'] = $meal->id;
                    $meal_attr_data['attribute_id'] = $attr;
                    $meal_attribute = MealAttribute::create($meal_attr_data);
                    if ($meal_attribute) {
                        foreach ($request->attr_options_ids[$attr] as $key => $option_id) {
                            $meal_attr_options_data['meal_id'] = $meal->id;
                            $meal_attr_options_data['meal_attribute_id'] = $meal_attribute->id;
                            $meal_attr_options_data['option_id'] = $option_id;
                            $meal_attr_options_data['price'] = $request->option_prices[$option_id][0];
                            MealAttributeOption::create($meal_attr_options_data);
                        }
                    }
                }
            }
            //Begin addons
            if (count($data['addons']) > 0) {
                foreach ($data['addons'] as $key => $addon) {
                    $meal_addon_data['meal_id'] = $meal->id;
                    $meal_addon_data['addon_id'] = $addon;
                    $meal_addon_data['price'] = $data['prices'][$key];
                    MealAddon::create($meal_addon_data);
                }
            }
        }
        session()->flash('success', trans('lang.addedsuccess'));
        return redirect()->back();
    }


    public function edit($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . 'edit', compact('data'));
    }

    public function change_status(Request $request)
    {
        $data['active'] = $request->status;
        $this->objectName::where('id', $request->id)->update($data);
        return 1;
    }


    public function update(MealsDashboardRequest $request)
    {
        $data = $request->validated();
        $this->objectName::findOrFail($data['id'])->update($data);
        session()->flash('success', trans('lang.updatSuccess'));
        return redirect()->back();
    }


    public function destroy($id)
    {
        $hospital = $this->objectName::findOrFail($id);
        try {
            $hospital->delete();
            session()->flash('success', trans('lang.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', trans('lang.emp_no_delete'));
        }
        return back();
    }

    public function attribute_data(Request $request)
    {
        $attribute = Attribute::find($request->attribute_id);
        $options = Option::where('attribute_id', $request->attribute_id)->get();
        return view('admin.restaurants.dashboard.parts.meal_options', compact('attribute', 'options'));
    }

    public function addon_data(Request $request)
    {
        $addon = Addon::find($request->addon_id);
        return view('admin.restaurants.dashboard.parts.meal_addons', compact('addon'));
    }
}
