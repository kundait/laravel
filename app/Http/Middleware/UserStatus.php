<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class UserStatus
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
        
        if (isset(auth()->user()->status) && ((auth()->user()->status) == 1)){
            return $next($request);
        }else{
       // Auth::guard()->logout();
        //$request->session()->flush();
       // $request->session()->regenerate();        
        return redirect('/dashboard');
        }
    }
}
