<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class usersController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(User $model)
    {
//        $this->middleware(['permission:employees']);
        $this->objectName = $model;
        $this->folderView = 'admin.users.';
    }

    public function index()
    {
        $user = \auth()->user();
        $users = $this->objectName::where('type', 'user')->orderBy('created_at', 'desc')->get();
        return view($this->folderView . 'users', compact('users'));
    }

    public function accept($id)
    {
        $user = User::find($id);
        $user->is_new = 'accepted';
        $user->created_at = Carbon::now();
        if ($user->save()) {
            $email = $user->email;
            $phone = $user->country_code . $user->phone;
            if ($user->main_lang == 'ar') {
                $title = Settings()->title_ar;
                $real_message = 'تم قبولك بموقع  ' . $title . '  رابط الموقع هنا :  ' . env('APP_URL');
            } else {
                $title = Settings()->title_en;
                $real_message = 'You have been accepted into the site  ' . $title . '  Website link here :  ' . env('APP_URL') ;

            }
            Mail::raw($real_message, function ($message) use ($email, $title) {
                $message->subject($title);
                $message->from(env('MAIL_USERNAME'), 'online learning');
                $message->to($email);
            });
            $this->SendSMS($phone, $real_message);
            Alert::success(trans('s_admin.join_orders'), trans('s_admin.accepted_s'));
            return redirect()->back();
        }
    }
    public function reject($id)
    {
        $user = User::find($id);
        $user->is_new = 'rejected';
        if ($user->save()) {
            $email = $user->email;
            $phone = $user->country_code . $user->phone;
            if($user->main_lang == 'ar'){
                $title = Settings()->title_ar;
                $real_message = 'تم رفضك من قبل الادارة - بموقع  ' . $title . '  رابط الموقع هنا :  ' . env('APP_URL') ;
            }else{
                $title = Settings()->title_en;
                $real_message = 'You have been rejected by the administration - Site  ' . $title . '  Website link here :  ' . env('APP_URL') ;

            }
            Mail::raw($real_message, function ($message) use ($email, $title) {
                $message->subject($title);
                $message->from(env('MAIL_USERNAME'), 'online learning');
                $message->to($email);
            });
            $this->SendSMS($phone, $real_message);
            Alert::success(trans('s_admin.join_orders'), trans('s_admin.rejected_s'));
            return redirect()->back();
        }
    }

    public function create()
    {
        $roles = Role::all();
        return view($this->folderView . 'create_user', compact('roles'));
    }

    public function store(Request $request)
    {

        $data = $this->validate(\request(),
            [
//                'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                'name' => 'required|unique:users,name',
                'email' => 'required|unique:users,email',
                'country_code' => 'required',
                'phone' => 'required|unique:users,phone',
                'role_id' => 'required|exists:roles,id',
                'college_id' => '',
                'gender' => 'required',
                'work_place' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:6',
            ]);
        $data['unique_name'] = time() . '_' . rand(1000, 9999);
        $user_phone = $request->country_code . '' . $request->phone;
        $exists_user = User::where('user_phone', $user_phone)->first();
        if ($exists_user) {
            session()->flash('error', trans('admin.user_exists'));
            return redirect()->back();
        }
        $data['user_phone'] = $user_phone;
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            $user = User::create($data);
            if ($user->save()) {
                $user->roles()->sync([$request->role_id]);
                $user->save();
                session()->flash('success', trans('admin.addedsuccess'));
                return redirect(url('users/create'));
            }
        }
    }


    public function get_collage_by_role_id(Request $request, $id)
    {
        if ($id == 3 || $id == 9 || $id == 10 || $id == 11) {
            //مدير مجمع
            $data = College::where('type', 'college')->where('deleted', '0')->get();
            return view('admin.users.parts.collage', compact('data'));
        } else if ($id == 5 || $id == 12 || $id == 13 || $id == 14) {
            //مدير دار
            $data = College::where('type', 'dorr')->where('deleted', '0')->get();
            return view('admin.users.parts.dorr', compact('data'));
        } else {
            return 1;
        }
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user_data = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'edit', \compact('user_data', 'roles'));
    }

    public function update(Request $request, $id)
    {
        if ($request['password'] != null) {
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,' . $id,
                    'country_code' => 'required',
                    'phone' => 'required|unique:users,phone,' . $id,
                    'password' => 'required|min:8|confirmed',
                    'college_id' => '',
                    'work_place' => '',
                    'gender' => 'required',
                    'role_id' => 'required|exists:roles,id'

                ]);
        } else {
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,' . $id,
                    'country_code' => 'required',
                    'phone' => 'required|unique:users,phone,' . $id,
                    'college_id' => '',
                    'gender' => 'required',
                    'work_place' => '',
                    'role_id' => 'required|exists:roles,id'
                ]);
        }
        $user_phone = $request->country_code . '' . $request->phone;
        $exists_user = User::where('id', '!=', $id)->first();
        if (!$exists_user) {
            session()->flash('error', trans('admin.user_exists'));
            return redirect()->back();
        }
        $data['user_phone'] = $user_phone;
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));

            User::where('id', $id)->update($data);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
            User::where('id', $id)->update($data);
        }
        $user = User::where('id', $id)->first();
        $user->roles()->sync([$request->role_id]);
        $user->save();
        session()->flash('success', trans('admin.updatSuccess'));
        return redirect(url('users'));
    }

    public function update_Actived(Request $request)
    {
        $data['status'] = $request->status;
        $user = User::where('id', $request->id)->update($data);
        return 1;
    }

    public function destroy($id)
    {
        $user = $this->objectName::where('id', $id)->first();
        try {
            $user->delete();
            session()->flash('success', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', trans('admin.emp_no_delete'));
        }
        return back();
    }
}
