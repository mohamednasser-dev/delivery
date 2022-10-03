<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class student
{
    public function handle($request, Closure $next)
    {
        if (\Auth::guard('student')->check()) {
            $request->id = \Auth::guard('student')->user()->id;
            return $next($request);
        } else {
            Alert::warning(trans('s_admin.alert'), trans('s_admin.you_should_login'));
            return back();
        }
    }
}
