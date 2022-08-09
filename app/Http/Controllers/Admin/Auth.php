<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\M_user_bo;
use App\Models\M_user_group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class Auth extends Controller
{

    public function login()
    {
        if(!empty(session()->get('logged_in'))){
            return redirect()->route('admin.main');
        }

        return view('web.auth.login');

    }

    public function authenticate(Request $request)
    {
    	$messages = [
            'username.required' => '* please enter your username',
            'password.required' => '* please enter your password',
        ];

        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'password' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return Response::json([
                'error' => [
                    'username' => $errors->first('username'),
                    'password' => $errors->first('password'),
                ]
            ]);
        }

		$cek = M_user_bo::where([
			'username' => $request->username,
			'aktif' => '1',
		])->first();

		if($cek){
			$cek_hash = \Hash::check($request->password, $cek->password);
			if ($cek_hash == false) {
                return \Response::json([
                    'error'  => [
                        'username' => 'Invalid username or password',
                    ]
                ]);
            } else if ($cek_hash === true) {
                $request->session()->put('logged_in', 'true');
                $request->session()->put('logged_in.id_m_user_bo', $cek->id_m_user_bo);
                $request->session()->put('logged_in.id_m_branch', $cek->id_m_branch);
                $request->session()->put('logged_in.nm_user', $cek->nm_user);
                $request->session()->put('logged_in.username', $cek->username);
                $request->session()->put('logged_in.nm_user_group', M_user_group::where('id_m_user_group',$cek->id_m_user_group)->first()->nm_user_group);
                $request->session()->put('logged_in.id_m_user_group', $cek->id_m_user_group);
                $cek->last_login = now();
                $cek->save();
            }

            return \Response::json([
                'redirect' => route('admin.main'),
                'status'  => true,
            ]);
		}else{
            return \Response::json([
                'error'  => [
                    'username' => 'Invalid username or password',
                ]
            ]);
        }

    }

    public function logout()
    {
		session()->forget('logged_in');
	    return redirect()->route('login');

    }


}
