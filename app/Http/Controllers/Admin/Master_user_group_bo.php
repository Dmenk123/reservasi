<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\M_menu;
use App\Models\M_module;
use App\Models\M_menu_bo;
use App\Models\M_hak_akses;
use App\Models\M_user_group;
use Illuminate\Http\Request;
use App\Models\M_hak_akses_bo;
use App\Models\M_user_group_bo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Master_user_group_bo extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'User Group BO',
            'page_title' => 'User Group BO',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User Group BO',
        ];

        return view('admin.m_user_group_bo.index')->with($data);
    }

    public function add()
    {
        $data = [
            'head_title' => 'User Group',
            'page_title' => 'User Group',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User Group',
        ];

    	return view('admin.m_user_group_bo.add')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            'nm_user_group_bo.required' => 'please fill out this field',
        ];

        $validator = Validator::make($request->all(), [
            'nm_user_group_bo' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'nm_user_group_bo' => $errors->first('nm_user_group_bo'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = new M_user_group_bo;
        $object->id_m_user_group_bo = M_user_group_bo::MaxId();
        $object->is_active_m_user_group_bo = $request->aktif;
        $object->nm_user_group_bo = $request->nm_user_group_bo;
        // $object->keterangan = $request->keterangan;
        try{

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_user_group_bo.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }


    public function edit()
    {
        abort_if(!request()->filled('id_m_user_group_bo') or !is_numeric(request('id_m_user_group_bo')), 404);

        $old = M_user_group_bo::where([
            'id_m_user_group_bo' => request('id_m_user_group_bo')
        ])->firstOrFail();


        $data = [
            'head_title' => 'User Group BO',
            'page_title' => 'User Group BO',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User Group BO',
            'old' => $old,
        ];

        return view('admin.m_user_group_bo.edit')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'nm_user_group_bo.required' => 'please fill out this field',
        ];

        $validator = Validator::make($request->all(), [
            'nm_user_group_bo' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nm_user_group_bo' => $errors->first('nm_user_group_bo'),
                ]
            ]);
        }


        DB::beginTransaction();
        $update = M_user_group_bo::where([
            'id_m_user_group_bo' => $request->id_m_user_group_bo,
        ])->first();

        if($update == null)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nm_user_group_bo' => 'Data not found !',
                ]
            ]);
        }

        $update->is_active_m_user_group_bo = $request->aktif;
        $update->nm_user_group_bo = $request->nm_user_group_bo;
        // $update->keterangan = $request->keterangan;
        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_user_group_bo.index'),
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
        if(!$request->filled('id_m_user_group_bo')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = M_user_group_bo::where([
            'id_m_user_group_bo' => $request->id_m_user_group_bo
        ])->first();

        if($find==null){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        DB::beginTransaction();

        try{
            M_hak_akses_bo::where('id_m_user_group_bo', $request->id_m_user_group_bo)->delete();

            $find->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.m_user_group_bo.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function datatable(Request $request)
    {

        $table = M_user_group_bo::orderByDesc('id_m_user_group_bo')->get();

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

    		$datas[$key][] = $i++;
            $datas[$key][] = $value->nm_user_group_bo;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y H:i:s');
            $datas[$key][] = ($value->is_active_m_user_group_bo=='1') ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Non Active</span>';
            $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item edit_hakakses" data-id_m_user_group_bo="'.$value->id_m_user_group_bo.'" href="javascript:void(0)">manage permission</a>
                                        <a class="dropdown-item" href="'.route('admin.m_user_group_bo.edit',['id_m_user_group_bo' => $value->id_m_user_group_bo]).'">edit</a>
                                        <a class="dropdown-item delete" data-id_m_user_group_bo="'.$value->id_m_user_group_bo.'" href="#">delete</a>
                                    </div>
                                </div>';
    	}

    	$data = [
    		'data' => $datas
    	];

    	return response()->json($data);
    }




    public function hakakses()
    {
        abort_if(!request()->filled('id_m_user_group_bo') or !is_numeric(request('id_m_user_group_bo')), 404);

        $old = M_user_group_bo::where([
            'id_m_user_group_bo' => request('id_m_user_group_bo')
        ])->firstOrFail();

        $menu = M_menu::whereNull('id_parent')->get();

        $data = [
            'head_title' => 'User Group',
            'page_title' => 'User Group',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User Group',
            'old' => $old,
            'menu' => $menu,
            // 'id_m_module' => M_module::where('active_m_module','ACTIVE')->get(),
        ];

        return view('admin.m_user_group_bo.hakakses')->with($data);
    }


    // public function hakakses_update(Request $request)
    // {
    //     $old = M_menu::get();
    //     foreach ($old as $value) {
    //         if($request->input('cek_'.$value->id_m_menu) != ''){
    //             $aksesUpdate = M_hak_akses::where([
    //                 'id_m_menu' => $value->id_m_menu,
    //                 'id_m_user_group' => $request->id_m_user_group,
    //             ])->first();

    //             if($aksesUpdate == null)
    //             {
    //                 $new = new M_hak_akses;
    //                 $new->id_m_hak_akses = M_hak_akses::maxId();
    //                 $new->id_m_menu = $value->id_m_menu;
    //                 $new->id_m_user_group = $request->id_m_user_group;
    //                 $new->save();
    //             }

    //         }else{

    //             $aksesUpdate = M_hak_akses::where([
    //                 'id_m_menu' => $value->id_m_menu,
    //                 'id_m_user_group' => $request->id_m_user_group,
    //             ])->first();


    //             if($aksesUpdate)
    //             {
    //                 $aksesUpdate->delete();
    //             }

    //         }

    //     }

    //     return response()->json([
    //         'status' => true,
    //         'redirect' => route('admin.m_user_group.index'),
    //     ]);
    // }


    public function manage()
    {
        $old = M_user_group_bo::where([
            'id_m_user_group_bo' => request()->get('id_m_user_group_bo')
        ])->firstOrFail();

        $menu = M_menu_bo::whereNull('id_parent')->get();

        $data = [
            'old' => $old,
            'menu' => $menu,
        ];

        return view('admin.m_user_group_bo.manage_permission_permodule')->with($data);
    }


    public function manage_post(Request $request)
    {
        // dd($request->all());
        $old = M_menu_bo::get();
        foreach ($old as $value) {
            if($request->input('cek_'.$value->id_m_menu_bo) != ''){
                $aksesUpdate = M_hak_akses_bo::where([
                    'id_m_menu_bo' => $value->id_m_menu_bo,
                    'id_m_user_group_bo' => $request->id_m_user_group_bo,
                ])->first();

                if($aksesUpdate == null)
                {
                    $new = new M_hak_akses_bo;
                    $new->id_m_hak_akses_bo = M_hak_akses_bo::maxId();
                    $new->id_m_menu_bo = $value->id_m_menu_bo;
                    $new->id_m_user_group_bo = $request->id_m_user_group_bo;
                    $new->save();
                }

            }else{

                M_hak_akses_bo::where([
                    'id_m_menu_bo' => $value->id_m_menu_bo,
                    'id_m_user_group_bo' => $request->id_m_user_group_bo,
                ])->delete();

            }

        }
        return response()->json([
            'status' => true,
            'redirect' => route('admin.m_user_group_bo.index'),
        ]);
    }


}
