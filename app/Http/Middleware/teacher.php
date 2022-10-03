<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class teacher
{
    public function handle($request, Closure $next)
    {
        if (\Auth::guard('teacher')->check()) {
            $request->id = \Auth::guard('teacher')->user()->id;
            return $next($request);
        } else {
            Alert::warning(trans('s_admin.alert'), trans('s_admin.you_should_login'));
            return redirect()->back();
        }
    }
}
