<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\City;
use App\Models\District;
use App\Models\Subject;
use App\Models\Subject_level;
use App\Models\Zone;
use App\Notifications\ForgetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
        if (auth()->user()){

            return redirect()->route('home');
        }


        if (session()->has('lang')) {
        } else {
            session()->put('lang', 'ar');
        }
    }

    public function lang($lang)
    {
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
        \App::setLocale($lang);
        if (\Auth::guard('web')->check()) {
            $user = User::whereId(auth()->guard('web')->user()->id)->first();
            $user->main_lang = $lang;
            $user->save();
        }
        return redirect()->back();
    }

    public function home()
    {

        return redirect()->route('login');
    }
    public function cache()
    {
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return 'success';
    }

}
