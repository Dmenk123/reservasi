<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Models\M_user_group;
use App\Models\M_user_bo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\M_branch;
use App\Models\M_user_project_group;

class Master_user_bo extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'User',
            'page_title' => 'User',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User',
        ];

        return view('admin.m_user_bo.index')->with($data);
    }

    public function add()
    {
        $data = [
            'head_title' => 'User',
            'page_title' => 'User',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User',
            'm_user_group'   => M_user_group::where('id_m_user_group','<>',1)->whereNotNull('aktif')->get(),
            'm_branch'   => M_branch::get(),
            'm_user_project_group'   => M_user_project_group::get(),
        ];

    	return view('admin.m_user_bo.add')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            'nm_user.required' => 'please fill out this field',
            'username.required' => 'please fill out this field',
            'username.min' => 'at least 6 characters letters or numbers',
            'username.alphanum' => 'enter letters or numbers',
            'password.required' => 'please fill out this field',
            'password.min' => 'at least 6 characters letters or numbers',
            'password.alphanum' => 'enter letters or numbers',
            'id_m_user_group.required' => 'please choose one',
            'id_m_branch.required' => 'please choose one',
        ];

        $validator = Validator::make($request->all(), [
            'nm_user' => ['required'],
            'username' => ['required','min:6','alphanum'],
            'password' => ['required','min:6','alphanum'],
            'id_m_user_group' => ['required'],
            'id_m_branch' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'nm_user' => $errors->first('nm_user'),
                'username' => $errors->first('username'),
                'password' => $errors->first('password'),
                'id_m_user_group' => $errors->first('id_m_user_group'),
                'id_m_branch' => $errors->first('id_m_branch'),
            ]
            ]);
        }

        DB::beginTransaction();
        $object = new M_user_bo;
        $object->id_m_user_bo = M_user_bo::MaxId();
        $object->nm_user = $request->nm_user;
        $object->aktif = $request->aktif;
        $object->username = $request->username;
        $object->password = bcrypt($request->password);
        $object->id_m_user_group = $request->id_m_user_group;
        $object->id_m_branch = $request->id_m_branch;
        $object->id_m_user_project_group = $request->id_m_user_project_group;


        try{
            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_user_bo.index'),
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
        abort_if(!request()->filled('id_m_user_bo') or !is_numeric(request('id_m_user_bo')), 404);

        $old = M_user_bo::where([
            'id_m_user_bo' => request('id_m_user_bo')
        ])->firstOrFail();


        $data = [
            'head_title' => 'User',
            'page_title' => 'User',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'User',
            'old' => $old,
            'm_user_group'   => M_user_group::where('id_m_user_group','<>',1)->whereNotNull('aktif')->get(),
            'm_branch'   => M_branch::get(),
            'm_user_project_group'   => M_user_project_group::get(),
        ];

        return view('admin.m_user_bo.edit')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'nm_user.required' => 'please fill out this field',
            'username.required' => 'please fill out this field',
            'username.min' => 'at least 6 characters letters or numbers',
            'username.alphanum' => 'enter letters or numbers',
            'password.min' => 'at least 6 characters letters or numbers',
            'password.alphanum' => 'enter letters or numbers',
            'id_m_user_group.required' => 'please choose one',
            'id_m_branch.required' => 'please choose one',
        ];

        $validator = Validator::make($request->all(), [
            'nm_user' => ['required'],
            'username' => ['required','min:6','alphanum'],
            'password' => ['nullable','min:6','alphanum'],
            'id_m_branch' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'nm_user' => $errors->first('nm_user'),
                'username' => $errors->first('username'),
                'password' => $errors->first('password'),
                'id_m_branch' => $errors->first('id_m_branch'),
            ]
            ]);
        }


        DB::beginTransaction();
        $update = M_user_bo::where([
            'id_m_user_bo' => $request->id_m_user_bo,
        ])->first();

        if($update == null)
        {
            $errors = $validator->errors();
            return response()->json([
            'error' => [
                'username' => 'Data not found !',
            ]
            ]);
        }


        if($update->username != $request->username)
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

        $update->nm_user = $request->nm_user;
        $update->aktif = $request->aktif;
        $update->username = $request->username;
        $update->id_m_branch = $request->id_m_branch;
        if($request->filled('password')){
            $update->password = bcrypt($request->password);
        }
        $update->id_m_user_group = $request->id_m_user_group;
        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_user_bo.index'),
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
        if(!$request->filled('id_m_user_bo')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = M_user_bo::where([
            'id_m_user_bo' => $request->id_m_user_bo
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
                'redirect' => route('admin.m_user_bo.index'),
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
        $table = M_user_bo::orderByDesc('id_m_user_bo')->get();
    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

            if($value->id_m_user_bo == session()->get('logged_in.id_m_user_bo')){
                $action_button = '';
            }else{
                $action_button = '<div class="btn-group">
                                        <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                        actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                            <a class="dropdown-item" href="'.route('admin.m_user_bo.edit',['id_m_user_bo' => $value->id_m_user_bo]).'">edit</a>
                                            <a class="dropdown-item delete" data-id_m_user_bo="'.$value->id_m_user_bo.'" href="#">delete</a>
                                        </div>
                                    </div>';
            }
            // $ug= M_user_group::where('id_m_user_group', $value->id_m_user_group)->first();
    		$datas[$key][] = $i++;
            $datas[$key][] = $value->username;
            $datas[$key][] = $value->nm_user;
            $datas[$key][] = ($value->id_m_branch)?M_branch::where('id_m_branch', $value->id_m_branch)->first()->nm_m_branch:'-';
            // dump($ug);
            $datas[$key][] = M_user_group::where('id_m_user_group',$value->id_m_user_group)->first()->nm_user_group;
            $datas[$key][] = $value->last_login ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->last_login)->format('d-m-Y H:m:s') : null;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y H:i:s');
            $datas[$key][] = ($value->aktif=='1') ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>';
            $datas[$key][] = $action_button;
    	}
        // die();

    	$data = [
    		'data' => $datas
    	];

    	return response()->json($data);
    }


}
