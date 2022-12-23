<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Admin\CancelReasonRequest;
use App\Models\CancelReason;
use Illuminate\Http\Request;

//use File;

class CancelReasonsController extends GeneralController
{
    protected $viewPath = 'admin.cancel_reasons.';
    protected $path = 'cancel_reasons';
    private $route = 'cancel_reasons';
    protected $paginate = 30;
    public $objectName;


    public function __construct(CancelReason $model)
    {
        parent::__construct($model);
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

    public function store(CancelReasonRequest $request)
    {
        $data = $request->validated();
        $this->objectName::create($data);
        session()->flash('success', trans('lang.addedsuccess'));
        return redirect()->route($this->route . '.index');
    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        return view($this->viewPath . '.edit', compact('data'));
    }

    public function update(CancelReasonRequest $request, $id)
    {
        $data = $request->validated();
        $this->model::where('id', $id)->update($data);
        session()->flash('success', trans('lang.updated_s'));
        return redirect()->route($this->route . '.index');
    }

    public function change_status(Request $request)
    {
        $data['active'] = $request->status;
        $this->objectName::where('id', $request->id)->update($data);
        return 1;
    }

    public function delete($id)
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
