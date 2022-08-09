<?php

namespace App\Http\Controllers\Web;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\M_candidate;
use App\Models\T_emp_request_rct;

class Profile_user extends Controller
{
    public function index()
    {
        $token = request()->get('token');
        if($token){
            try{
                $token_decrypt = \Crypt::decrypt($token);
                T_emp_request_rct::where('id_t_emp_request_rct', $token_decrypt)->where('date_end_vacancy', '>=', Carbon::now())->firstOrfail();
            }catch(\Exception $e){
                abort(404);
            }
        }

        $old = M_candidate::where('id_m_user_fo', session()->get('fo_logged_in.id_m_user_fo'))->first();
        $personal_data = $old ?? null;
        
        $data = [
            'head_title' => 'User Profile',
            'page_title' => 'User Profile',
            'child_menu_active'   => 'User Profile',
            'old'   => $personal_data,
        ];

        return view('web.step_profile_user.index')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            'email_m_user_fo.required' => __('validation.required'),
            'email_m_user_fo.email' => __('validation.email'),
            'hp_m_user_fo.required' => __('validation.required'),
            'hp_m_user_fo.numeric' => __('validation.numeric'),
            'nm_m_user_fo.required' => __('validation.required'),
            'nik_m_user_fo.required' => __('validation.required'),
            'nik_m_user_fo.size' => __('validation.size', ['attribute' => 'NIK', 'value' => 16]),
        ];

        $validator = Validator::make($request->all(), [
            'email_m_user_fo' => ['required','email'],
            'hp_m_user_fo' => ['required','numeric'],
            'nm_m_user_fo' => ['required'],
            'nik_m_user_fo' => ['required','size:16'],

        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'email_m_user_fo' => $errors->first('email_m_user_fo'),
                    'hp_m_user_fo' => $errors->first('hp_m_user_fo'),
                    'nm_m_user_fo' => $errors->first('nm_m_user_fo'),
                    'nik_m_user_fo' => $errors->first('nik_m_user_fo'),
                    'password' => $errors->first('password'),
                ]
            ]);
        }

        DB::beginTransaction();
        $find_user_in_master_candidate = M_candidate::where('id_m_user_fo', session()->get('fo_logged_in.id_m_user_fo'))->first();
        if($find_user_in_master_candidate){
            $new_obj = M_candidate::where('id_m_candidate', $find_user_in_master_candidate->id_m_candidate)->first();
            $id_m_candidate = $new_obj->id_m_candidate;
        }else{
            $new_obj = new M_candidate;
            $id_m_candidate = M_candidate::MaxId();
        }

        $object = $new_obj;
        $object->id_m_candidate = $id_m_candidate;
        $object->id_m_user_fo = session()->get('fo_logged_in.id_m_user_fo');
        $object->email_m_candidate = $request->email_m_user_fo;
        $object->nik_m_candidate = $request->nik_m_user_fo;
        $object->nm_m_candidate = strtoupper($request->nm_m_user_fo);
        $object->hp_m_candidate = $request->hp_m_user_fo;
        try{
            $token = $request->token;
            $object->save();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => __('notif.berhasil_simpan'),
                'redirect' => route('web.biodata.index', ['token' => $token]),
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
