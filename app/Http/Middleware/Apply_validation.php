<?php

namespace App\Http\Middleware;

use App\Models\T_applicant;
use Closure;
use Illuminate\Http\Request;

class Apply_validation
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
        if(session()->get('fo_logged_in.id_m_user_fo')){
            if(request()->filled('token')){
                try{
                    $decrypted = \Crypt::decrypt(request()->get('token'));
                }catch(\Exception $e){
                    abort(404);
                }

                $status_tombol_apply = T_applicant::whereHas('m_candidate', function($query){
                    $query->whereHas('m_user_fo', function($query){
                        $query->where('id_m_user_fo', session()->get('fo_logged_in.id_m_user_fo'));
                    });
                })
                ->where('id_t_emp_request_rct', $decrypted)
                ->whereNull('is_qualified')
                ->count();
                abort_if($status_tombol_apply > 0 ,404);
            }
            
        }

        return $next($request);
    }
}
