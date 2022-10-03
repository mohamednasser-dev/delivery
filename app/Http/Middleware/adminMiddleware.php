<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
          if (auth()->guard('web')->check() && auth()->guard('web')->user()->type == 'admin' || auth()->guard('web')->check() && auth()->guard('web')->user()->type == 'user' ) {
            return $next($request);
        } else {
              Alert::warning(trans('s_admin.alert'), trans('s_admin.you_should_login'));
            return redirect()->route('main_page');

        }
    }
}
