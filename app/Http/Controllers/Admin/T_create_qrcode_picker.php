<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\M_module;
use App\Models\M_user_bo;
use App\Http\Controllers\Controller;
use App\Models\M_branch;
use App\Models\M_branch_company;
use App\Models\M_company;
use App\Models\M_employee;
use App\Models\M_entity;
use App\Models\T_qrcode;
use App\Models\M_project;
use QrCode;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class T_create_qrcode extends Controller
{

    public function index()
    {

        $data = [
            'head_title' => 'Create Qrcode',
            'page_title' => 'Create Qrcode',
            'parent_menu_active' => null,
            'child_menu_active'   => 'Create Qrcode',
            //'show_tombol_lengkapi'   => $show_tombol_lengkapi,
        ];
    	return view('admin.t_create_qrcode.index',$data);
    }


    public function add_modal(Request $request)
    {
        $data = [
            'id_m_entity'   => M_entity::where('active_m_entity', 'ACTIVE')->orderBy('nm_m_entity')->get(),
            'id_m_branch'   => M_branch::where('active_m_branch', 'ACTIVE')->orderBy('nm_m_branch')->get(),
            'id_m_company'   => M_company::where('active_m_company', 'ACTIVE')->orderBy('nm_m_company')->get(),
            'm_project'   => M_project::where('active_m_project', 'ACTIVE')->orderBy('nm_m_project')->get(),
        ];
        return view('admin.t_create_qrcode.add_modal')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            // 'id_m_company.required' => 'please choose one',
            // 'id_m_branch_company.required' => 'please choose one',
            'id_m_project.required' => 'please choose one',
            'tipe_t_qrcode.required' => 'please choose one',
           // 'id_m_branch_pelasana.required' => 'please choose one',
            'pic_participant.required' => 'required',
            'pic_eo.required' => 'required',
            'date_start_mcu.required' => 'required',
            'date_finish_mcu.required' => 'required',
        ];

        $validator = Validator::make($request->all(), [
            // 'id_m_company' => ['required'],
            // 'id_m_branch_company' => ['required'],
            'id_m_project' => ['required'],
            'tipe_t_qrcode' => ['required'],
           // 'id_m_branch_pelaksana' => ['required'],
            'pic_participant' => ['required'],
            'pic_eo' => ['required'],
            'date_start_mcu' => ['required'],
            'date_finish_mcu' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    // 'id_m_company' => $errors->first('id_m_company'),
                    // 'id_m_branch_company' => $errors->first('id_m_branch_company'),
                    'id_m_project' => $errors->first('id_m_project'),
                    'tipe_t_qrcode' => $errors->first('tipe_t_qrcode'),
                    //'id_m_branch_pelaksana' => $errors->first('id_m_branch_pelaksana'),
                    'pic_participant' => $errors->first('pic_participant'),
                    'pic_eo' => $errors->first('pic_eo'),
                    'date_start_mcu' => $errors->first('date_start_mcu'),
                    'date_finish_mcu' => $errors->first('date_finish_mcu'),
                ]
            ]);
        }

        DB::beginTransaction();

        if ($request->id_m_branch){
            $pelaksana=$request->id_m_branch;
        }else if ($request->id_m_branch_company) {
            $pelaksana=$request->id_m_branch_pelaksana;

        }else {

            $pelaksana='';
        }
        $object = new T_qrcode;
        $object->id_t_qrcode = T_qrcode::MaxId();
        $object->id_m_branch = $request->id_m_branch;
        $object->id_m_project = $request->id_m_project;
        // $object->id_m_branch_pelaksana = $request->id_m_branch_pelaksana;
        $object->id_m_branch_pelaksana = $pelaksana;
        $object->tipe_t_qrcode = $request->tipe_t_qrcode;
        $object->id_m_branch_company = $request->id_m_branch_company;
        $object->pic_participant = $request->pic_participant;
        $object->pic_eo = $request->pic_eo;
        $object->date_start_mcu = ($request->date_start_mcu) ? Carbon::createFromFormat('d-m-Y', $request->date_start_mcu)->format('Y-m-d') : null;
        $object->date_finish_mcu = ($request->date_finish_mcu) ? Carbon::createFromFormat('d-m-Y', $request->date_finish_mcu)->format('Y-m-d') : null;
        try{

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.t_create_qrcode.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }



    public function edit_modal(Request $request)
    {
        $old = T_qrcode::where([
            'id_t_qrcode' => $request->id_t_qrcode,
        ])
        ->with('m_branch')
        ->with('m_branch_company')
        ->first();

        $data = [
            'old' => $old,
            'id_m_entity'   => M_entity::where('active_m_entity', 'ACTIVE')->orderBy('nm_m_entity')->get(),
            'id_m_company'   => M_company::where('active_m_company', 'ACTIVE')->orderBy('nm_m_company')->get(),
            'id_m_branch'   => M_branch::where('active_m_branch', 'ACTIVE')->orderBy('nm_m_branch')->get(),
            'm_project'   => M_project::where('active_m_project', 'ACTIVE')->orderBy('nm_m_project')->get(),
        ];

        return view('admin.t_create_qrcode.edit_modal')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'id_t_qrcode.required' => 'required',
            // 'id_m_company.required' => 'please choose one',
            // 'id_m_branch_company.required' => 'please choose one',
            // 'id_m_entity.required' => 'please choose one',
            'id_m_project.required' => 'please choose one',
            'pic_participant.required' => 'required',
            'pic_eo.required' => 'required',
            'date_start_mcu.required' => 'required',
            'date_finish_mcu.required' => 'required',
        ];

        $validator = Validator::make($request->all(), [
            'id_t_qrcode' => ['required'],
            // 'id_m_company' => ['required'],
            // 'id_m_branch_company' => ['required'],
            // 'id_m_entity' => ['required'],
            'id_m_project' => ['required'],
            'pic_participant' => ['required'],
            'pic_eo' => ['required'],
            'date_start_mcu' => ['required'],
            'date_finish_mcu' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_t_qrcode' => $errors->first('id_t_qrcode'),
                    // 'id_m_company' => $errors->first('id_m_company'),
                    // 'id_m_branch_company' => $errors->first('id_m_branch_company'),
                    // 'id_m_entity' => $errors->first('id_m_entity'),
                    'id_m_project' => $errors->first('id_m_project'),
                    'pic_participant' => $errors->first('pic_participant'),
                    'pic_eo' => $errors->first('pic_eo'),
                    'date_start_mcu' => $errors->first('date_start_mcu'),
                    'date_finish_mcu' => $errors->first('date_finish_mcu'),
                ]
            ]);
        }


        DB::beginTransaction();
        $update = T_qrcode::where([
            'id_t_qrcode' => $request->id_t_qrcode,
        ])->first();

        if($update == null)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_m_branch' => 'Data not found !',
                ]
            ]);
        }

        $update->id_m_branch = $request->id_m_branch;
        $update->id_m_branch_company = $request->id_m_branch_company;
        $update->id_m_branch_pelaksana = $request->id_m_branch_pelaksana;
        $update->id_m_project = $request->id_m_project;
        $update->tipe_t_qrcode = $request->tipe_t_qrcode;
        $update->pic_participant = $request->pic_participant;
        $update->pic_eo = $request->pic_eo;
        $update->date_start_mcu = ($request->date_start_mcu) ? Carbon::createFromFormat('d-m-Y', $request->date_start_mcu)->format('Y-m-d') : null;
        $update->date_finish_mcu = ($request->date_finish_mcu) ? Carbon::createFromFormat('d-m-Y', $request->date_finish_mcu)->format('Y-m-d') : null;
        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.t_create_qrcode.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }

    public function delete(Request $request)
    {
        if(!$request->filled('id_t_qrcode')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = T_qrcode::where([
            'id_t_qrcode' => $request->id_t_qrcode
        ])->first();

        if($find==null){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        DB::beginTransaction();

        try{
            $find->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.t_create_qrcode.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

        return response()->json([
            'message' => $e->getMessage(),
            'status'  => false,
        ]);
    }


    public function datatable(Request $request)
    {

        $table = T_qrcode::with('m_branch')
                 ->with('m_branch_company', function($query){
                     $query->with('m_company');
                 })
                 ->orderBy('id_t_qrcode')->get();

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

            if ($value->id_m_branch){

               $location= $value->m_branch->nm_m_branch;

            }else  if ($value->id_m_branch_company){


                $location=$value->m_branch_company->m_company->nm_m_company.' - '.$value->m_branch_company->nm_m_branch_company;



            }else {

                $location='';
            }

    		$datas[$key][] = $i++;
            // $datas[$key][] = ($value->id_m_branch) ? $value->m_branch->nm_m_branch : '';
            // $datas[$key][] = ($value->id_m_branch_company) ? $value->m_branch_company->m_company->nm_m_company.' - '.$value->m_branch_company->nm_m_branch_company : '';
            $datas[$key][] = ($location) ? $location : '';
            $datas[$key][] = ($value->date_start_mcu and $value->date_finish_mcu) ? Carbon::createFromFormat('Y-m-d', $value->date_start_mcu)->isoFormat('D MMMM YYYY').' - '.Carbon::createFromFormat('Y-m-d', $value->date_finish_mcu)->isoFormat('D MMMM YYYY') : '';
            $datas[$key][] = $value->pic_participant;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at)->format('d-m-Y H:i:s');
            // $datas[$key][] = '<div class="btn-group">
            //                         <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
            //                         actions
            //                         </button>
            //                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
            //                             <a class="dropdown-item edit" data-id_t_qrcode="'.$value->id_t_qrcode.'" href="javascript:void(0)">edit</a>
            //                             <a class="dropdown-item" href="'.route('web.check_in', ['id_t_qrcode' => $value->id_t_qrcode]).'" target="_blank">Go to Check In</a>
            //                             <a class="dropdown-item" href="'.route('web.check_out', ['id_t_qrcode' => $value->id_t_qrcode]).'" target="_blank">Go to Check Out</a>
            //                             <a class="dropdown-item check_in_modal" data-id_t_qrcode="'.$value->id_t_qrcode.'" href="javascript:void(0)">QR Code (Check In)</a>
            //                             <a class="dropdown-item check_out_modal" data-id_t_qrcode="'.$value->id_t_qrcode.'" href="javascript:void(0)">QR Code (Check Out)</a>
            //                             <a class="dropdown-item delete" data-id_t_qrcode="'.$value->id_t_qrcode.'" href="#">delete</a>
            //                         </div>
            //                     </div>';

            $datas[$key][] = '<div class="btn-group">
            <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
            actions
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                <a class="dropdown-item edit" data-id_t_qrcode="'.$value->id_t_qrcode.'" href="javascript:void(0)">edit</a>
                <a class="dropdown-item check_in_modal" data-id_t_qrcode="'.$value->id_t_qrcode.'"  data-tipe_t_qrcode="'.$value->tipe_t_qrcode.'" href="javascript:void(0)">QR Code (Check In)</a>
                <a class="dropdown-item check_out_modal" data-id_t_qrcode="'.$value->id_t_qrcode.'" data-tipe_t_qrcode="'.$value->tipe_t_qrcode.'"  href="javascript:void(0)">QR Code (Check Out)</a>
                <a class="dropdown-item delete" data-id_t_qrcode="'.$value->id_t_qrcode.'" href="#">delete</a>
            </div>
        </div>';
    	}

    	$data = [
    		'data' => $datas
    	];

    	return response()->json($data);
    }

    public function iframe_qr_in(Request $request)
    {
        return view('admin.t_create_qrcode.iframe_in');
    }


    public function qr_in()
    {
        abort_if(!request()->filled('id_t_qrcode'), 404);

        $id = request()->get('id_t_qrcode');
        $tipe = request()->get('tipe_t_qrcode');

        // echo QrCode::size(400)->generate(route('web.check_in', ['id_t_qrcode' => $id]));die;

        $get = T_qrcode::where('id_t_qrcode', $id)
                ->with('m_branch', function($query){
                    $query->with('entity');
                })
                ->with('m_branch_company', function($query){
                    $query->with('m_company');
                })
                ->firstOrFail();
        $data = [
            'row' => $get,
            'qrcode' => base64_encode(QrCode::format('svg')->size(470)->errorCorrection('H')->generate(route('web.check_in', ['id_t_qrcode' => $id, 'tipe_t_qrcode' => $tipe]))),
        ];

        $pdf = PDF::loadView('admin.t_create_qrcode.qr_in', $data);
        $pdf->setPaper('Legal', 'P');
        return $pdf->stream("QRCODE_CHECK_IN_".time().".pdf", array("Attachment" => false));
    }

    public function iframe_qr_out(Request $request)
    {
        return view('admin.t_create_qrcode.iframe_out');
    }

    public function qr_out()
    {
        abort_if(!request()->filled('id_t_qrcode'), 404);

        $id = request()->get('id_t_qrcode');
        $tipe = request()->get('tipe_t_qrcode');

        $get = T_qrcode::where('id_t_qrcode', $id)
                ->with('m_branch', function($query){
                    $query->with('entity');
                })
                ->with('m_branch_company', function($query){
                    $query->with('m_company');
                })
                ->firstOrFail();
        $data = [
            'row' => $get,
            'qrcode' => base64_encode(QrCode::format('svg')->size(470)->errorCorrection('H')->generate(route('web.check_out', ['id_t_qrcode' => $id, 'tipe_t_qrcode' => $tipe]))),
        ];

        $pdf = PDF::loadView('admin.t_create_qrcode.qr_out', $data);
        $pdf->setPaper('Legal', 'P');
        return $pdf->stream("QRCODE_CHECK_OUT_".time().".pdf", array("Attachment" => false));
    }


    public function handle_edit_t_qrcode(Request $request)
    {
        $findbranch = M_branch::orderBy('nm_m_branch')->where('id_m_entity', $request->id_m_entity)->where('active_m_branch', 'ACTIVE')->get();
        $html_branch = '';

        foreach ($findbranch as $item) {
            $html_branch .= "<option ".($request->id_m_branch == $item->id_m_branch ? 'selected' : null)." value=".$item->id_m_branch.">".$item->nm_m_branch."</option>";
        }

        $findbranchc = M_branch_company::orderBy('nm_m_branch_company')->where('id_m_company', $request->id_m_company)->where('active_m_branch_company', 'ACTIVE')->get();
        $html_branch_company = '';

        foreach ($findbranchc as $item) {
            $html_branch_company .= "<option ".($request->id_m_branch_company == $item->id_m_branch_company ? 'selected' : null)." value=".$item->id_m_branch_company.">".$item->nm_m_branch_company."</option>";
        }

        return response()->json([
            'html_branch' => $html_branch,
            'html_branch_company' => $html_branch_company,
        ]);
    }


}
