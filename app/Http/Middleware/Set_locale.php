<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Set_locale
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
        if(request()->segment(1)==null) {
            return redirect()->to('/id'); /**DEFAULT LOCALIZATION TO INDONESIA */
        }else if(request()->segment(1)!=null and request()->segment(1)=='admin'){
            return redirect()->to('/admin/login');
        }else if(request()->segment(1)!=null and !in_array(request()->segment(1), ['en','id'])){
            return redirect()->to('/id');
        }
        return $next($request);
    }
}
