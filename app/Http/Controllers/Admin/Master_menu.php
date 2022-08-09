<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Models\M_user_group;
use App\Models\M_menu;
use App\Models\M_hak_akses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class Master_menu extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'Admin Menu',
            'page_title' => 'Admin Menu',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Admin Menu',
        ];

        return view('admin.m_menu.index')->with($data);
    }

    public function add()
    {
        $data = [
            'head_title' => 'Admin Menu',
            'page_title' => 'Admin Menu',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Admin Menu',
            'id_parent'   => M_menu::whereNull('id_parent')->where('aktif','1')->get(),
        ];

    	return view('admin.m_menu.add')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            'nm_menu.required' => 'please fill out this field',
            'icon.required' => 'please fill out this field',
            'order_m_menu.numeric' => 'please fill number only',
        ];

        $validator = Validator::make($request->all(), [
            'nm_menu' => ['required'],
            'icon' => ['required'],
            'order_m_menu' => ['numeric'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nm_menu' => $errors->first('nm_menu'),
                    'icon' => $errors->first('icon'),
                    'order_m_menu' => $errors->first('order_m_menu'),
                ]
            ]);
        }


        DB::beginTransaction();
        $object = new M_menu;
        $object->id_m_menu = M_menu::MaxId();
        $object->aktif = $request->aktif;
        $object->nm_menu = $request->nm_menu;
        $object->order_m_menu = $request->order_m_menu;
        $object->icon = $request->icon;
        $object->id_parent = $request->id_parent;
        $object->route = $request->route;
        $object->order_m_menu = $request->order_m_menu;
        try{

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_menu.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }


    public function save_api(Request $request)
    {



        DB::beginTransaction();
        $object = new M_menu;
        $object->id_m_menu = M_menu::MaxId();
        $object->aktif = $request->aktif;
        $object->nm_menu = $request->nm_menu;
        $object->order_m_menu = $request->order_m_menu;
        $object->icon = $request->icon;
        $object->id_parent = $request->id_parent;
        $object->route = $request->route;
        $object->order_m_menu = $request->order_m_menu;
        $object->save();

        // return "MASUK";

    }


    public function edit()
    {
        abort_if(!request()->filled('id_m_menu') or !is_numeric(request('id_m_menu')), 404);

        $old = M_menu::where([
            'id_m_menu' => request('id_m_menu')
        ])->firstOrFail();


        $data = [
            'head_title' => 'Admin Menu',
            'page_title' => 'Admin Menu',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Admin Menu',
            'old' => $old,
            'id_parent'   => M_menu::whereNull('id_parent')->where('aktif','1')->get(),
        ];

        return view('admin.m_menu.edit')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'nm_menu.required' => 'please fill out this field',
            'icon.required' => 'please fill out this field',
            'order_m_menu.numeric' => 'please fill number only',
        ];

        $validator = Validator::make($request->all(), [
            'nm_menu' => ['required'],
            'icon' => ['required'],
            'order_m_menu' => ['numeric'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nm_menu' => $errors->first('nm_menu'),
                    'icon' => $errors->first('icon'),
                    'order_m_menu' => $errors->first('order_m_menu'),
                ]
            ]);
        }


        DB::beginTransaction();
        $update = M_menu::where([
            'id_m_menu' => $request->id_m_menu,
        ])->first();

        if($update == null)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nm_menu' => 'Data not found !',
                ]
            ]);
        }

        $update->aktif = $request->aktif;
        $update->nm_menu = $request->nm_menu;
        $update->icon = $request->icon;
        $update->route = $request->route;
        $update->id_parent = $request->id_parent;
        $update->order_m_menu = $request->order_m_menu;
        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_menu.index'),
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
        if(!$request->filled('id_m_menu')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = M_menu::where([
            'id_m_menu' => $request->id_m_menu
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
                'redirect' => route('admin.m_menu.index'),
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

        $table = M_menu::orderByDesc('id_m_menu')->get();

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

    		$datas[$key][] = $i++;
            $datas[$key][] = $value->nm_menu;
            $datas[$key][] = ($value->aktif=='1') ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            $datas[$key][] = $value->icon;
            $datas[$key][] = $value->route;
            $datas[$key][] = ($value->id_parent) ? M_menu::whereNotNull('aktif')->where('id_m_menu', $value->id_parent)->first()->nm_menu : null;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y H:i:s');
            $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item" href="'.route('admin.m_menu.edit',['id_m_menu' => $value->id_m_menu]).'">edit</a>
                                        <a class="dropdown-item delete" data-id_m_menu="'.$value->id_m_menu.'" href="#">delete</a>
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
        ];

        return view('admin.m_user_group.hakakses')->with($data);
    }


    public function hakakses_update(Request $request)
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

                $aksesUpdate = M_hak_akses::where([
                    'id_m_menu' => $value->id_m_menu,
                    'id_m_user_group' => $request->id_m_user_group,
                ])->first();


                if($aksesUpdate)
                {
                    $aksesUpdate->delete();
                }

            }

        }

        return response()->json([
            'status' => true,
            'redirect' => route('admin.m_user_group.index'),
        ]);
    }


}
