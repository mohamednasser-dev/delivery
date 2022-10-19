<?php

namespace App\Http\Controllers\Admin;


use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class   LoginController extends Controller
{
    public function __construct()
    {

        if (\Auth::guard('web')->check()) {
            return redirect('/home');
        }
    }


    public function login_both(Request $request)
    {
        $remeber = Request('Remember') == 1 ? true : false;
        if (auth::guard('web')->attempt(['email' => Request('email'), 'password' => Request('password')], $remeber)) {
            Alert::success(trans('admin.login_done'), trans('admin.hello'));
            return redirect('/home');
        } else {
            Alert::error(trans('s_admin.invalid_informations'), trans('admin.invaldemailorpassword'));
            return back();
        }
    }


    public function show_login()
    {
        return view('front.login');
    }


    public function logout()
    {
        $user = Auth::user();
        Auth::logout();
        return redirect('/');
    }

}
