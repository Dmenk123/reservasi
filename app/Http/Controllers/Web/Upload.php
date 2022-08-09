<?php

namespace App\Http\Controllers\Web;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\M_candidate;
use App\Models\M_candidate_doc;
use App\Models\T_doc_applicant;
use App\Models\T_emp_request_rct;
use App\Models\T_syarat_doc_rct;

class Upload extends Controller
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
        }else{
            abort(404);
        }

        $old = M_candidate::where('id_m_user_fo', session()->get('fo_logged_in.id_m_user_fo'))->first();
        $personal_data = $old ?? null;

        $data = [
            'head_title' => 'Upload',
            'page_title' => 'Upload',
            'child_menu_active'   => 'Upload',
            'old'   => $personal_data,
        ];

        return view('web.step_upload.index')->with($data);
    }

    public function table_upload(Request $request)
    {
        $candidate = $request->id_m_candidate;
        // $list = T_syarat_doc_rct::where('id_t_emp_request_rct', $request->id_t_emp_request_rct)
        //         ->with('t_doc_applicant', function($query) use ($candidate){
        //             $query->where('id_m_candidate', $candidate)->first();
        //         })
        //         ->with('m_candidate_doc', function($query) use ($candidate){
        //             $query->where('id_m_candidate', $candidate)->first();
        //         })
        //         ->with('doc_type', function($query){
        //             $query->where('active_m_doc_type', 'ACTIVE')->get();
        //         })->get();
        $list = DB::table('t_syarat_doc_rct')->select('t_syarat_doc_rct.id_t_syarat_doc_rct', 't_doc_applicant.*', 'm_doc_type.*')->where('id_t_emp_request_rct', $request->id_t_emp_request_rct)
                ->leftJoin('t_doc_applicant', function($join) use ($candidate){
                    $join->on('t_doc_applicant.id_t_syarat_doc_rct', '=', 't_syarat_doc_rct.id_t_syarat_doc_rct');
                })
                // ->leftJoin('m_candidate_doc', function($join) use ($candidate){
                //     $join->on('m_candidate_doc.id_t_syarat_doc_rct', '=', 't_syarat_doc_rct.id_t_syarat_doc_rct')->where('m_candidate_doc.id_m_candidate', $candidate);
                // })
                ->leftJoin('m_doc_type', function($join){
                    $join->on('m_doc_type.id_m_doc_type', '=', 't_syarat_doc_rct.id_m_doc_type');
                })
                ->where('t_syarat_doc_rct.id_t_emp_request_rct', $request->id_t_emp_request_rct)

                // ->leftJoin('m_candidate_doc', function ($join) {
                //     $join->on('users.id', '=', 'contacts.user_id')->orOn(...);
                // })
                ->get();

        $list = DB::table('t_syarat_doc_rct')
                ->where('t_syarat_doc_rct.id_t_emp_request_rct', $request->id_t_emp_request_rct)
                ->leftJoin('m_doc_type', function($join){
                    $join->on('m_doc_type.id_m_doc_type', '=', 't_syarat_doc_rct.id_m_doc_type');
                })->get();
        $html = '';
        $i = 1;
        // dd($list);
        if($list->count() > 0){
            foreach($list as $lis)
            {
                $is_upload = DB::table('t_doc_applicant')->where('id_m_candidate', $candidate)->where('id_t_syarat_doc_rct', $lis->id_t_syarat_doc_rct)->first();
                $html .= '<tr>';
                $html .= '<td>'.$i.'</td>';
                $html .= '<td>'.strtoupper($lis->naration_m_doc_type).'</td>';

                if($is_upload){
                    $get_file = M_candidate_doc::where('id_m_candidate_doc', $is_upload->id_m_candidate_doc)->first();
                    $html .= '<td><a data-id_t_syarat_doc_rct="'.$lis->id_t_syarat_doc_rct.'" data-id_m_candidate="'.$request->id_m_candidate.'" class="btn btn-sm btn-secondary square open_modal_bank_data">'.__('step_upload.button.choose').'</a>&nbsp;&nbsp;<a data-id_t_syarat_doc_rct="'.$lis->id_t_syarat_doc_rct.'" data-id_m_candidate="'.$request->id_m_candidate.'" class="btn btn-sm btn-info square open_modal_upload">upload</a> <a href="javascript:void(0);" data-id_t_syarat_doc_rct="'.$lis->id_t_syarat_doc_rct.'" data-id_m_candidate="'.$request->id_m_candidate.'" data-id_t_doc_applicant="'.$is_upload->id_t_doc_applicant.'" class="btn open_modal_preview btn-sm square btn-warning">preview</a></td>';
                }else{
                    $html .= '<td><a data-id_t_syarat_doc_rct="'.$lis->id_t_syarat_doc_rct.'" data-id_m_candidate="'.$request->id_m_candidate.'" class="btn btn-sm btn-secondary square open_modal_bank_data">'.__('step_upload.button.choose').'</a>&nbsp;&nbsp;<a data-id_t_syarat_doc_rct="'.$lis->id_t_syarat_doc_rct.'" data-id_m_candidate="'.$request->id_m_candidate.'" class="btn btn-sm square btn-info open_modal_upload">upload</a></td>';
                }
                $html .= '</tr>';
                $i++;
            }
        }else{
            $html .= '<tr>';
            $html .= '<td colspan="3">No Requirements yet</td>';
            $html .= '</tr>';
        }

        return response()->json([
            'html_syarat' => $html,
        ]);
    }

    public function save(Request $request)
    {
        $messages = [
            'note_applied_another_branch.required' => __('validation.required'),
        ];

        $validator = Validator::make($request->all(), [
            'note_applied_another_branch' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'note_applied_another_branch' => $errors->first('note_applied_another_branch'),
                ]
            ]);
        }

        DB::beginTransaction();
        $find_user_in_master_candidate = M_candidate::where('id_m_user_fo', session()->get('fo_logged_in.id_m_user_fo'))->first();
        if($find_user_in_master_candidate){
            $new_obj = M_candidate::where('id_m_candidate', $find_user_in_master_candidate->id_m_candidate)->first();
            $id_m_candidate = $new_obj->id_m_candidate;
        }else{
            return response()->json([
                'message' => 'candidate not found !',
                'status'  => false,
            ]);
        }

        $object = $new_obj;
        $object->id_m_candidate = $id_m_candidate;
        $object->note_applied_another_branch  = $request->note_applied_another_branch;
        try{
            $token = $request->token;
            $object->save();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => __('notif.berhasil_simpan'),
                'redirect' => route('web.other_notes.index', ['token' => $token]),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }


    /** UPLOAD FILE DOCUMENT */

    public function show_form_upload_lampiran(Request $request)
    {
        abort_if(($request->id_t_syarat_doc_rct == null or $request->id_m_candidate == null),404);

        return view('web.step_upload.form_upload_lampiran', [
            'id_t_syarat_doc_rct' => $request->id_t_syarat_doc_rct,
            'id_m_candidate' => $request->id_m_candidate,
            'requirement' => T_syarat_doc_rct::where('id_t_syarat_doc_rct',$request->id_t_syarat_doc_rct)->with('doc_type', function($query){
                                $query->where('active_m_doc_type', 'ACTIVE')->first();
                             })->first(),
        ]);
    }

    public function upload_file(Request $request)
    {
        $find_master_syarat = T_syarat_doc_rct::where('id_t_syarat_doc_rct',$request->id_t_syarat_doc_rct)->with('doc_type', function($query){
                                $query->where('active_m_doc_type', 'ACTIVE')->first();
                             })->first();
        $mimes = 'mimes:'.str_replace(' ','',$find_master_syarat->doc_type->mime_m_doc_type);
        // dd($mimes);
        $messages = [
            'file_upload.required' => __('validation.required'),
            'file_upload.mimes' => __('validation.mimes'),
        ];

        $validator = Validator::make($request->all(), [
            'file_upload' => ['required',$mimes],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'file_upload' => $errors->first('file_upload'),
                ]
            ]);
        }

        if($request->file('file_upload')->getSize() >= 2000000)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'file_upload' => __('validation.size'),
                ]
            ]);
        }


        DB::beginTransaction();
        $object = new M_candidate_doc;
        $object->id_m_candidate_doc = M_candidate_doc::MaxId();
        $object->id_m_type_doc = $request->id_m_type_doc;
        $object->id_t_syarat_doc_rct = $find_master_syarat->id_t_syarat_doc_rct;
        $object->id_m_candidate = $request->id_m_candidate;

        $applic = new T_doc_applicant;
        $applic->id_t_doc_applicant = T_doc_applicant::MaxId();
        $applic->id_t_syarat_doc_rct = $find_master_syarat->id_t_syarat_doc_rct;
        $applic->id_m_candidate = $request->id_m_candidate;
        $applic->id_m_candidate_doc = M_candidate_doc::MaxId();

        try{

            if($request->file('file_upload')){
                $userid = session()->get('fo_logged_in.id_m_user_fo');
                $filename = time() . '_' . $request->file('file_upload')->getClientOriginalName();
                $folder = 'files';
                $f = $folder.'/'.$userid;
                $path = \Storage::disk('public')->putFileAs($f, $request->file('file_upload'), $filename);
                $object->upload_m_candidate_doc = $path;
            }

            $delete_previous_trans = T_doc_applicant::where([
                'id_t_syarat_doc_rct' => $find_master_syarat->id_t_syarat_doc_rct,
                'id_m_candidate' => $request->id_m_candidate,
            ])->delete();

            $object->save();
            $applic->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => __('notif.berhasil_simpan'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function show_form_bank_data(Request $request)
    {
        abort_if(($request->id_t_syarat_doc_rct == null or $request->id_m_candidate == null),404);

        return view('web.step_upload.form_bank_data', [
            'id_t_syarat_doc_rct' => $request->id_t_syarat_doc_rct,
            'id_m_candidate' => $request->id_m_candidate,
            'bank' => M_candidate_doc::where('id_t_syarat_doc_rct',$request->id_t_syarat_doc_rct)->where('id_m_candidate', $request->id_m_candidate)->orderByDesc('id_m_candidate_doc')->first(),
            'requirement' => T_syarat_doc_rct::where('id_t_syarat_doc_rct',$request->id_t_syarat_doc_rct)->with('doc_type', function($query){
                                $query->where('active_m_doc_type', 'ACTIVE')->first();
                             })->first(),
        ]);
    }

    
    public function submit_bank_data(Request $request)
    {
        $find_master_syarat = T_syarat_doc_rct::where('id_t_syarat_doc_rct',$request->id_t_syarat_doc_rct)->with('doc_type', function($query){
            $query->where('active_m_doc_type', 'ACTIVE')->first();
         })->first();

        $applic = new T_doc_applicant;
        $applic->id_t_doc_applicant = T_doc_applicant::MaxId();
        $applic->id_t_syarat_doc_rct = $find_master_syarat->id_t_syarat_doc_rct;
        $applic->id_m_candidate = $request->id_m_candidate;
        $applic->id_m_candidate_doc = $request->id_m_candidate_doc;

        try{
            T_doc_applicant::where([
                'id_t_syarat_doc_rct' => $find_master_syarat->id_t_syarat_doc_rct,
                'id_m_candidate' => $request->id_m_candidate,
            ])->delete();

            $applic->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => __('notif.berhasil_simpan'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function show_preview(Request $request)
    {
        // dd($request->id_t_syarat_doc_rct);
        abort_if(($request->id_t_doc_applicant==null),404);
        // abort_if(($request->id_t_syarat_doc_rct == null or $request->id_m_candidate == null),404);
        $get_file = T_doc_applicant::with('m_candidate_doc')->where('id_t_doc_applicant', $request->id_t_doc_applicant)->firstOrFail();
        return view('web.step_upload.preview', [
            'bank' => $get_file,
            'requirement' => T_syarat_doc_rct::where('id_t_syarat_doc_rct',$request->id_t_syarat_doc_rct)->with('doc_type', function($query){
                $query->where('active_m_doc_type', 'ACTIVE')->first();
             })->first(),
        ]);
    }


}
