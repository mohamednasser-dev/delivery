<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class HomeController extends Controller
{
    public function __construct()
    {


    }

    public function index()
    {

        $count['users'] = User::user()->get()->count();
        $count['restaurants'] = Restaurant::get()->count();
        return view('admin.home', compact('count'));
    }

    public function profile()
    {
        $data = User::where('id', auth()->user()->id)->first();

        return view('admin.profile.index', compact('data'));
    }

    public function store_profile(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp',
                'name' => 'required',
                'phone' => ''
            ]);
        if ($request['image'] != null) {
            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('/uploads/users_images'), $fileNewName);
            $data['image'] = $fileNewName;
        } else {
            $data['image'] = 'default_cert.png';
        }
        $data['phone'] = $request->phone;
        User::where('id', auth()->user()->id)->update($data);
        Alert::success(trans('s_admin.personal_info'), trans('s_admin.proileupdated_s'));
        return back();
    }

    public function update_pass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
            'curr_pass' => 'required',
        ]);
        $pass = User::find(auth()->user()->id)->password;
        if (\Hash::check($request->curr_pass, $pass)) {
            $data = User::find(auth()->user()->id);
            $data->password = \Hash::make($request->password);
            $data->save();
            Alert::success(trans('s_admin.success'), "تم تغيير كلمة المرور بنجاح ");
            return back()->with('message', trans('s_admin.pass_changed'));
        } else {
            Alert::error(trans('s_admin.error'), "كلمة المرور الحالية غير صحيحة ");
            return back()->with('message', 'كلمة المرور الحالية غير صحيحة   ');
        }
    }
}
