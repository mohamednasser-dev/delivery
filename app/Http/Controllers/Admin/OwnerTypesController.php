<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerTypesRequest;
use App\Models\OwnerType;
use Exception;

class OwnerTypesController extends Controller
{
    protected $viewPath = 'admin.owner_types.';
    private $route = 'owner_types';
    protected $paginate = 30;
    public $objectName;

    public function __construct(OwnerType $model)
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

    public function store(OwnerTypesRequest $request)
    {
        $data = $request->validated();
        $this->objectName::create($data);
        session()->flash('success', trans('lang.addedsuccess'));
        return redirect()->route($this->route . '.index');
    }


    public function edit($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . 'edit', compact('data'));
    }


    public function update(DoctorsRequest $request, $id)
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
