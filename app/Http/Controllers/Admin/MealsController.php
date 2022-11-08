<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AddonsDashboardRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MealsDashboardRequest;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Meal;
use App\Models\MealAddon;
use App\Models\MealAttribute;
use App\Models\MealAttributeOption;
use App\Models\Option;
use Illuminate\Http\Request;
use Exception;

class MealsController extends Controller
{
    protected $viewPath = 'admin.meals.';
    private $route = 'meals';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Meal $model)
    {
        $this->objectName = $model;
    }

    public function index()
    {
        $data = $this->objectName::orderBy('created_at', 'desc')->get();
        return view($this->viewPath . 'index', compact('data'));
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
                        foreach ($request->attr_options_ids[$attr] as $key=> $option_id) {
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
