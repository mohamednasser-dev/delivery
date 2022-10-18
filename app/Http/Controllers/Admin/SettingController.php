<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;

class SettingController extends GeneralController
{

    protected $viewPath = 'admin.setting.';
    protected $path = 'setting';
    protected $quality = 100;
    protected $encode = 'png';


    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }


    /**
     * Get All Data Model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $data = $this->model->get();
        return view($this->viewPath . 'edit', compact('data'));
    }


    public function update(SettingRequest $request)
    {
        $data = $this->model->get();
        $inputs = $request->validated();
        if ($request->hasFile('logo')) {
            $inputs['logo'] = $this->uploadImage($request->file('logo'), $this->path, $data->where('key', 'logo')->first()->val);
            if (env('APP_ENV') != 'local') {
                if ($data->where('key', 'logo')->first()->val != 'uploads/setting/web_logo.png') {
                    $this->deleteImage($data->where('key', 'logo')->first()->val);
                }
            }
        }
        if ($request->hasFile('logo_login')) {
            $inputs['logo_login'] = $this->uploadImage($request->file('logo_login'), $this->path, $data->where('key', 'logo_login')->first()->val);
            if (env('APP_ENV') != 'local') {
                if ($data->where('key', 'logo_login')->first()->val != 'uploads/setting/login_page_logo.png') {
                    $this->deleteImage($data->where('key', 'logo_login')->first()->val);
                }
            }
        }
        if ($request->hasFile('login_pg')) {
            $inputs['login_pg'] = $this->uploadImage($request->file('login_pg'), $this->path, $data->where('key', 'login_pg')->first()->val, null, 900);
            if (env('APP_ENV') != 'local') {
                if ($data->where('key', 'login_pg')->first()->val != 'uploads/setting/login_pg.png') {
                    $this->deleteImage($data->where('key', 'login_pg')->first()->val);
                }
            }
        }
        $this->model->setMany($inputs);
        $this->flash('success', 'تم التحديث');
        return back();
    }
}
