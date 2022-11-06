<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AttributeDashboardRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionsDashboardRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Exception;

class OptionsController extends Controller
{
    protected $viewPath = 'admin.restaurants.dashboard.';
    private $route = 'options';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Option $model)
    {
        $this->objectName = $model;
    }

    public function index($id)
    {
        $data = $this->objectName::where('attribute_id',$id)->orderBy('created_at', 'desc')->get();
        return view($this->viewPath . 'options', compact('data'));
    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function store(OptionsDashboardRequest $request)
    {
        $data = $request->validated();
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


    public function update(OptionsDashboardRequest $request)
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
}
