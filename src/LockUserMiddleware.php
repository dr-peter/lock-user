<?php

namespace DrPeter\LockUser;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LockUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::get('locked', false)) {
            $view = (view()->exists('vendor.dr-peter.lock-user.lockscreen')) ? 'vendor.dr-peter.lock-user.lockscreen' : 'userlock::lockscreen';
            $user = Auth::user();
            return response()->view($view, compact('user'));
        }
        return $next($request);
    }
}
