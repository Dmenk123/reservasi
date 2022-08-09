<?php

namespace App\Http\Controllers\Web;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\M_employee;
use App\Models\M_user_fo;

class Auth extends Controller
{
    public function login()
    {
        if(!empty(session()->get('fo_logged_in'))){
            return redirect()->route('web.home');
        }

        $data = [
            'head_title' => 'Login',
            'page_title' => 'Login',
            'child_menu_active'   => 'Login',
        ];

        return view('web.auth.login')->with($data);

    }


    public function authenticate(Request $request)
    {
    	$messages = [
            'nip_m_employee.required' => '* please enter your email',
        ];

        $validator = Validator::make($request->all(), [
            'nip_m_employee' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nip_m_employee' => $errors->first('nip_m_employee'),
                ]
            ]);
        }

		$cek = M_employee::where([
			'nip_m_employee' => $request->nip_m_employee,
		])->first();

		if($cek){
            return response()->json([
                'status'  => true,
            ]);
		}

		return response()->json([
            'status'  => false,
            'message'  => 'NIP Invalid !',
        ]);
    }

    


}
