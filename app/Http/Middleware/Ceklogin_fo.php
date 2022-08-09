<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Ceklogin_fo
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
        if(session('fo_logged_in')==null){
            return redirect()->route('web.auth.login');
        }
        return $next($request);
    }
}
