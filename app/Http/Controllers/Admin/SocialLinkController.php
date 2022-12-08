<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LinkDataTable;
use App\Http\Controllers\GeneralController;

use App\Http\Requests\Admin\LinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends GeneralController
{
    protected $viewPath = 'admin.link';
    protected $path = 'links';
    private $route = 'links';
    protected $paginate = 30;

    public function __construct(SocialLink $model)
    {
        parent::__construct($model);
    }

    public function index(LinkDataTable $dataTable)
    {
        return $dataTable->render($this->viewPath . '.index');
    }

    public function create()
    {
        return view($this->viewPath . '.create');
    }

    public function store(LinkRequest $request)
    {
        $data = $request->validated();
//        if($request->image){
//            if (is_file($request->image)) {
//                $img_name = time() . random_int(0000,9999) . '.' . $request->image->getClientOriginalExtension();
//                $request->image->move(public_path('/uploads/screens/'), $img_name);
//                $data['image'] = $img_name;
//            }
//        }
        $this->model::create($data);
        return redirect()->route($this->route)->with('success', 'تم الاضافة بنجاح');

    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        return view($this->viewPath . '.edit', compact('data'));
    }

    public function update(LinkRequest $request, $id)
    {
        $data = $request->validated();
        if($request->image){
            if (is_file($request->image)) {
                $img_name = time() . random_int(0000,9999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('/uploads/links/'), $img_name);
                $data['image'] = $img_name;
            }
        }
        $this->model::where('id', $id)->update($data);
        return redirect()->route($this->route)->with('success', 'تم التعديل بنجاح');

    }

    public function delete(Request $request, $id)
    {
        try {
            $data = $this->model::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $e) {
            return redirect()->route($this->route)->with('danger', 'لا يمكنك الحذف لاستخدام الدولة عن طريق العملاء');
        }

    }
}
