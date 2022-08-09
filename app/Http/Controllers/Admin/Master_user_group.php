<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\M_module;
use App\Models\M_hak_akses;
use App\Models\M_user_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Master_user_group extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'User Group FO',
            'page_title' => 'User Group FO',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User Group FO',
        ];

        return view('admin.m_user_group_fo.index')->with($data);
    }

    public function add()
    {
        $app = M_app::where('is_active_m_app', 1)->orderBy('nm_m_app')->get();
        $data = [
            'head_title' => 'User Group FO',
            'page_title' => 'User Group FO',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User Group FO',
            'app' => $app
        ];

    	return view('admin.m_user_group_fo.add')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            'nm_user_group.required' => 'please fill out this field',
            'id_m_app.required' => 'please choose one',
        ];

        $validator = Validator::make($request->all(), [
            'nm_user_group' => ['required'],
            'id_m_app' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'nm_user_group' => $errors->first('nm_user_group'),
                'id_m_app' => $errors->first('id_m_app'),
            ]
            ]);
        }


        DB::beginTransaction();
        $object = new M_user_group;
        $object->id_m_user_group = M_user_group::MaxId();
        $object->is_active_m_user_group = $request->aktif;
        $object->nm_user_group = $request->nm_user_group;
        $object->id_m_app = $request->id_m_app;
        // $object->keterangan = $request->keterangan;
        try{

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_user_group.index'),
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
        abort_if(!request()->filled('id_m_user_group') or !is_numeric(request('id_m_user_group')), 404);
        $app = M_app::where('is_active_m_app', 1)->orderBy('nm_m_app')->get();
        $old = M_user_group::with('m_app')->where([
            'id_m_user_group' => request('id_m_user_group')
        ])->firstOrFail();


        $data = [
            'head_title' => 'User Group FO',
            'page_title' => 'User Group FO',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User Group FO',
            'old' => $old,
            'app' => $app
        ];

        // dd($data);

        return view('admin.m_user_group_fo.edit')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'nm_user_group.required' => 'please fill out this field',
            'id_m_app.required' => 'please choose one',
        ];

        $validator = Validator::make($request->all(), [
            'nm_user_group' => ['required'],
            'id_m_app' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nm_user_group' => $errors->first('nm_user_group'),
                    'id_m_app' => $errors->first('id_m_app'),
                ]
            ]);
        }


        DB::beginTransaction();
        $update = M_user_group::where([
            'id_m_user_group' => $request->id_m_user_group,
        ])->first();

        if($update == null)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nm_user_group' => 'Data not found !',
                    'id_m_app' => 'Data not found !',
                ]
            ]);
        }

        $update->is_active_m_user_group = $request->aktif;
        $update->nm_user_group = $request->nm_user_group;
        $update->id_m_app = $request->id_m_app;
        // $update->keterangan = $request->keterangan;
        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_user_group.index'),
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
        if(!$request->filled('id_m_user_group')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = M_user_group::where([
            'id_m_user_group' => $request->id_m_user_group
        ])->first();

        if($find==null){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        DB::beginTransaction();

        try{
            M_hak_akses::where('id_m_user_group', $request->id_m_user_group)->delete();

            $find->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.m_user_group.index'),
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

        $table = M_user_group::with('m_app')->orderByDesc('id_m_user_group')->get();

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

    		$datas[$key][] = $i++;
            $datas[$key][] = $value->m_app->nm_m_app;
            $datas[$key][] = $value->nm_user_group;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y H:i:s');
            $datas[$key][] = ($value->is_active_m_user_group=='1') ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Non Active</span>';
            $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item edit_hakakses" data-id_m_user_group="'.$value->id_m_user_group.'" href="javascript:void(0)">manage permission</a>
                                        <a class="dropdown-item" href="'.route('admin.m_user_group.edit',['id_m_user_group' => $value->id_m_user_group]).'">edit</a>
                                        <a class="dropdown-item delete" data-id_m_user_group="'.$value->id_m_user_group.'" href="#">delete</a>
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
        abort_if(!request()->filled('id_m_user_group') or !is_numeric(request('id_m_user_group')), 404);

        $old = M_user_group::where([
            'id_m_user_group' => request('id_m_user_group')
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

        return view('admin.m_user_group_fo.hakakses')->with($data);
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
        $old = M_user_group::where([
            'id_m_user_group' => request()->get('id_m_user_group')
        ])->firstOrFail();

        $menu = M_menu::whereNull('id_parent')->get();

        $data = [
            'old' => $old,
            // 'id_m_module' => request()->get('id_m_module'),
            'menu' => $menu,
        ];

        return view('admin.m_user_group_fo.manage_permission_permodule')->with($data);
    }


    public function manage_post(Request $request)
    {
        $old = M_menu::get();
        foreach ($old as $value) {
            if($request->input('cek_'.$value->id_m_menu) != ''){
                $aksesUpdate = M_hak_akses::where([
                    'id_m_menu' => $value->id_m_menu,
                    'id_m_user_group' => $request->id_m_user_group,
                ])->first();

                if($aksesUpdate == null)
                {
                    $new = new M_hak_akses;
                    $new->id_m_hak_akses = M_hak_akses::maxId();
                    $new->id_m_menu = $value->id_m_menu;
                    $new->id_m_user_group = $request->id_m_user_group;
                    $new->save();
                }

            }else{

                M_hak_akses::where([
                    'id_m_menu' => $value->id_m_menu,
                    'id_m_user_group' => $request->id_m_user_group,
                ])->delete();

            }

        }
        return response()->json([
            'status' => true,
            'redirect' => route('admin.m_user_group.index'),
        ]);
    }


}
