<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PageDataTable;
use App\Http\Controllers\GeneralController;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

//use File;

class PageController extends GeneralController
{
    protected $viewPath = 'admin.page';
    protected $path = 'pages';
    private $route = 'pages';
    protected $paginate = 30;

    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function index(PageDataTable $dataTable)
    {
        $parent_id = null;
        return $dataTable->with('parent_id', $parent_id)->render($this->viewPath . '.index');
    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        return view($this->viewPath . '.edit', compact('data'));
    }

    public function update(PageRequest $request, $id)
    {
        $data = $request->validated();
        if($request->image){
            if (is_file($request->image)) {
                $img_name = time() . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('/uploads/pages/'), $img_name);
                $data['image'] = $img_name;
            }
        }
        $this->model::where('id', $id)->update($data);
        return redirect()->route($this->route )->with('success', 'تم التعديل بنجاح');

    }
}
