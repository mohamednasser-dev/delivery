<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Admin\CouponRequest;
use App\Http\Requests\Admin\OffersRequest;
use App\Models\Coupon;
use App\Models\Meal;
use App\Models\Restaurant;

//use File;

class CouponsController extends GeneralController
{
    protected $viewPath = 'admin.coupons.';
    protected $path = 'coupons';
    private $route = 'coupons';
    protected $paginate = 30;
    public $objectName;


    public function __construct(Coupon $model)
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
        $restaurants = Restaurant::accepted()->active()->orderBy('created_at', 'desc')->get();
        $meals = Meal::accepted()->active()->orderBy('created_at', 'desc')->get();
        return view($this->viewPath . 'create', compact('meals','restaurants'));
    }

    public function store(CouponRequest $request)
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

    public function update(CouponRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->image) {
            if (is_file($request->image)) {
                $img_name = time() . random_int(0000, 9999) . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('/uploads/pages/'), $img_name);
                $data['image'] = $img_name;
            }
        }
        $this->model::where('id', $id)->update($data);
        session()->flash('success', trans('lang.updated_s'));

        return redirect()->route($this->route . '.index');


    }
}
