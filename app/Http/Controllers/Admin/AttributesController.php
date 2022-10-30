<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AttributeDashboardRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Exception;

class AttributesController extends Controller
{
    protected $viewPath = 'admin.attributes.';
    private $route = 'attributes';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Attribute $model)
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

    public function store(AttributeDashboardRequest $request, $id)
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


    public function update(AttributeDashboardRequest $request)
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
