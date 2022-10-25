<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\categoryDashboardRequest;
use App\Http\Requests\Admin\RestaurantTypeRequest;
use App\Models\Category;
use App\Models\RestaurantType;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $viewPath = 'admin.categories.';
    private $route = 'categories';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Category $model)
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

    public function store(categoryDashboardRequest $request, $id)
    {
        $data = $request->validated();
        $data['restaurant_id'] = $id;
        $this->objectName::create($data);
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


    public function update(RestaurantTypeRequest $request, $id)
    {
        $data = $request->validated();
        $this->objectName::findOrFail($id)->update($data);
        session()->flash('success', trans('lang.updatSuccess'));
        return redirect()->route($this->route . '.index');
    }


    public function destroy($id)
    {
        $hospital = $this->objectName::findORFail($id);
        try {
            $hospital->delete();
            session()->flash('success', trans('lang.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', trans('lang.emp_no_delete'));
        }
        return back();
    }
}
