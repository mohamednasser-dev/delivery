<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
        $year = Carbon::now()->year;
        $count['users'] = User::user()->get()->count();
        $count['restaurants'] = Restaurant::get()->count();

        //for admin chart3
        //restaurants
        $restaurants_by_month = Restaurant::whereYear('created_at', $year)
            ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year', 'month')
            ->get();
        $users_by_month = User::user()->whereYear('created_at', $year)
            ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year', 'month')
            ->get();
        $restaurants_arr[0] = "";
        $restaurants_arr[1] = "";
        $restaurants_arr[2] = "";
        $restaurants_arr[3] = "";
        $restaurants_arr[4] = "";
        $restaurants_arr[5] = "";
        $restaurants_arr[6] = "";
        $restaurants_arr[7] = "";
        $restaurants_arr[8] = "";
        $restaurants_arr[9] = "";
        $restaurants_arr[10] = "";
        $restaurants_arr[11] = "";
        $restaurants_arr[12] = "";

        foreach ($restaurants_by_month as $key => $row) {
            $student_month_count[$key] = $row->data;
//                    $months[$key] = date('F', strtotime($row->month)) ;
            $months[$key] = $row->month;
            $years[$key] = $row->year;
            $new_month = $row->month - 1;
            $restaurants_arr[$new_month] = $row->data;
        }

        $users_arr[0] = "";
        $users_arr[1] = "";
        $users_arr[2] = "";
        $users_arr[3] = "";
        $users_arr[4] = "";
        $users_arr[5] = "";
        $users_arr[6] = "";
        $users_arr[7] = "";
        $users_arr[8] = "";
        $users_arr[9] = "";
        $users_arr[10] = "";
        $users_arr[11] = "";
        $users_arr[12] = "";
        //teachers

        foreach ($users_by_month as $key => $row) {
            $teachers_month_count[$key] = $row->data;
            $new_month = $row->month - 1;
            $users_arr[$new_month] = $row->data;
        }
        $restaurants_arr = json_encode($restaurants_arr);
        $users_arr = json_encode($users_arr);

        return view('admin.home', compact('count', 'restaurants_arr', 'users_arr','year'));
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
