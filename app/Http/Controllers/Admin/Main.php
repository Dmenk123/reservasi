<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\M_module;
use App\Models\M_user_bo;
use App\Http\Controllers\Controller;
use App\Models\M_employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Main extends Controller
{

    public function index()
    {

        $data = [
            'head_title' => 'Dashboard',
            'page_title' => 'Dashboard',
            'parent_menu_active' => null,
            'child_menu_active'   => 'Dashboard',
            //'show_tombol_lengkapi'   => $show_tombol_lengkapi,
        ];
    	return view('admin.main.index',$data);
    }

    public function handle_before_open_module()
    {

        // return redirect()->route('admin.main')->with(
        //     'id_m_module' , request()->get('id_m_module')
        // );
    }

    public function edit_profile()
    {
        $data = [
            'head_title' => 'Edit Profile',
            'page_title' => 'Edit Profile',
            'parent_menu_active' => null,
            'child_menu_active'   => 'Edit Profile',
        ];
    	return view('admin.main.edit_profile',$data);
    }

    public function edit_profile_post(Request $request)
    {
        $messages = [
            'nama.required' => 'please fill out this field',
            'username.required' => 'please fill out this field',
        ];

        $validator = Validator::make($request->all(), [
            'nm_user' => ['required'],
            'username' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'nm_user' => $errors->first('nm_user'),
                'username' => $errors->first('username'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = M_user_bo::where('id_m_user_bo', session()->get('logged_in.id_m_user_bo'))->first();

        if($object->username != $request->username)
        {
            $find_duplicate = M_user_bo::where('username', $request->username)->count();
            if($find_duplicate > 0)
            {
                return response()->json([
                    'error' => [
                        'username' => 'This username is already in use, please use another username !',
                    ]
                ]);
            }
        }

        $object->nm_user = $request->nm_user;
        $object->username = $request->username;
        if($request->filled('password')){
            $object->password = bcrypt($request->password);
        }
        try{

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Profile has been changed',
                'redirect' => route('admin.edit_profile'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }


}
