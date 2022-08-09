<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\M_token;
use App\Models\M_hak_akses;
use App\Models\T_applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Validasi_req
{
    public function handle(Request $request, Closure $next)
    {
        // if(session()->get('fo_logged_in.id_m_user_fo')){
            if(request()->filled('token')){
                try{
                   $cek_token = M_token::where('id_m_token', request()->get('token'))->where('expired_at', '>=', Carbon::now()->format('Y-m-d H:i:s'))->firstOrFail();
                   $id_app = $cek_token->id_m_app;
                   $id_user_group = $cek_token->id_m_user_group;
                }catch(\Exception $e){
                    // dd($e->getMessage());
                    abort(404);
                }

                $request->request->add(['id_app' => $id_app, 'id_user_group' => $id_user_group]);
            }

        // }

        return $next($request);
    }
}
