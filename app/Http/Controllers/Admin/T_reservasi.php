<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\T_content;
use App\Models\M_component;
use App\Models\M_user_group;
use Illuminate\Http\Request;
use App\Models\T_content_det;
use App\Models\T_group_content;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class T_reservasi extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'Reservasi',
            'page_title' => 'Reservasi',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Reservasi',

        ];

        return view('admin.t_reservasi.index')->with($data);
    }

    public function datatable(Request $request)
    {
        $table = T_content::with(['m_app', 'm_menu', 'm_user_group', 't_content_det'])->IsActive()->orderByDesc('created_at')->get();

    	$datas = [];
    	$i = 1;

        // dd($table);

    	foreach ($table as $key => $value) {
            $is_user_group_exist = false;

    		$datas[$key][] = $i++;
            $datas[$key][] = $value->m_app->nm_m_app;
            $datas[$key][] = $value->m_menu->nm_menu;
            $datas[$key][] = $value->title_t_content;
            $datas[$key][] = $value->subtitle_t_content;

            $list = '<ul>';
            foreach ($value->m_user_group as $k => $v) {
                $is_user_group_exist = true;
                $list .= '<li>'.$v->nm_user_group.'</li>';
            }
            $list .= '<ul>';

            $datas[$key][] = $list;

            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y H:i:s');

            if($is_user_group_exist) {
                $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item setting" href="'.route('admin.t_content.set_content').'?id_t_content='.$value->id_t_content.'">set content</a>
                                        <a class="dropdown-item user-group" data-id_t_content="'.$value->id_t_content.'" href="javascript:void(0)">user group</a>
                                        <a class="dropdown-item edit" data-id_t_content="'.$value->id_t_content.'" href="javascript:void(0)">edit</a>
                                        <a class="dropdown-item delete" data-id_t_content="'.$value->id_t_content.'" href="#">delete</a>
                                    </div>
                                </div>';
            }else{
                $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item user-group" data-id_t_content="'.$value->id_t_content.'" href="javascript:void(0)">user group</a>
                                        <a class="dropdown-item edit" data-id_t_content="'.$value->id_t_content.'" href="javascript:void(0)">edit</a>
                                        <a class="dropdown-item delete" data-id_t_content="'.$value->id_t_content.'" href="#">delete</a>
                                    </div>
                                </div>';
            }


    	}

    	$data = [
    		'data' => $datas
    	];

    	return response()->json($data);
    }

    public function set_content()
    {
        $content = T_content::with(['m_app', 'm_menu', 't_content_det', 'm_user_group'])->where('id_t_content', request()->get('id_t_content'))->firstOrFail();
        $content_det = T_content_det::with('m_component')->where('id_t_content',  request()->get('id_t_content'))->orderBy('sort_t_content_det')->get();
        $data = [
            'head_title' => 'Content Data',
            'page_title' => 'Content Data',
            'parent_menu_active' => 'Content Management',
            'child_menu_active' => 'Content Data',
            'old' => $content,
            'old_det' => $content_det,
            'component' => M_component::orderBy('nm_m_component', 'asc')->get(),
        ];

    	return view('admin.t_content_management.set_content')->with($data);
    }

    public function add_modal(Request $request)
    {
        $app_data = M_app::IsActive()->orderBy('nm_m_app')->get();

        $data = [
            'head_title' => 'Content Data',
            'page_title' => 'Content Data',
            'parent_menu_active' => 'Content Management',
            'child_menu_active' => 'Content Data',
            'app_data' => $app_data
        ];

        return view('admin.t_content_management.add_modal')->with($data);
    }

    public function load_user_group(Request $request)
    {
        $user_group = M_user_group::where('id_m_app', $request->id_m_app)->get();

        $res = '<option value="">Please choose one</option>';
        foreach ($user_group as $value) {
            $res .= '<option value="' . $value->id_m_user_group . '" >' . $value->nm_user_group . '</option>';
        }

        return response($res);
    }

    public function load_menu(Request $request)
    {
        $menu = M_menu::where(['aktif' => '1', 'id_m_app' => $request->id_m_app])->orderBy('nm_menu')->get();

        $res = '<option value="">Please choose one</option>';
        foreach ($menu as $value) {
            $res .= '<option value="' . $value->id_m_menu . '" >' . $value->nm_menu . '</option>';
        }

        return response($res);
    }

    public function save(Request $request)
    {
        // dd($request->all());
        $messages = [
            'id_m_app.required' => 'please choose one',
            // 'id_m_user_group.required' => 'please choose one',
            'id_m_menu.required' => 'please choose one',
            'title_t_content.required' => 'please fill this field',
            'subtitle_t_content.required' => 'please fill this field',
        ];

        $validator = Validator::make($request->all(), [
            'id_m_app' => ['required'],
            // 'id_m_user_group' => ['required'],
            'id_m_menu' => ['required'],
            'title_t_content' => ['required'],
            'subtitle_t_content' => ['required'],

        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_m_app' => $errors->first('id_m_app'),
                    // 'id_m_user_group' => $errors->first('id_m_user_group'),
                    'id_m_menu' => $errors->first('id_m_menu'),
                    'title_t_content' => $errors->first('title_t_content'),
                    'subtitle_t_content' => $errors->first('subtitle_t_content'),
                ]
            ]);
        }

        // cek exist
        $cek = T_content::where(['id_m_app' => $request->id_m_app, 'id_m_menu' => $request->id_m_menu])->first();

        if($cek) {
            return response()->json([
                'message' => 'Transaction is exist, please check again',
                'status'  => false,
            ]);
        }


        DB::beginTransaction();
        $object = new T_content;
        $object->id_t_content = T_content::MaxId();
        $object->id_m_app = $request->id_m_app;
        // $object->id_m_user_group = $request->id_m_user_group;
        $object->id_m_menu = $request->id_m_menu;
        $object->id_m_user_bo = session()->get('logged_in.id_m_user_bo');
        $object->title_t_content = $request->title_t_content;
        $object->is_active_t_content = 1;
        $object->subtitle_t_content = $request->subtitle_t_content;
        $object->created_at = Carbon::now()->format('Y-m-d H:i:s');

        try{

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.t_content.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }

    public function save_set_content(Request $request)
    {
        // dd($request->all());
        if(!$request->filled('id_t_content')) {
            return response()->json([
                'status' => false,
                'message' => 'Content not found',
                'redirect' => route('admin.t_content.index'),
            ]);
        }

        $messages = [
            'form_type.required' => 'please choose one',
            'content_field.required' => 'please fill this field',
        ];

        if(in_array($request->form_type, [M_component::ID_M_COMPONENT_IMAGE, M_component::ID_M_COMPONENT_VIDEO])) {
            if($request->form_type == M_component::ID_M_COMPONENT_IMAGE) {
                $arr_mimes_valid = ['required','mimes:png,jpeg,jpg','max:204800'];
            }else{
                $arr_mimes_valid = ['required','mimes:m4v,avi,flv,mp4,mov','max:204800'];
            }

            $validator = Validator::make($request->all(), [
                'form_type' => ['required'],
                'content_field' => $arr_mimes_valid,
                'caption_field' => ['required'],
            ], $messages);

            $errors = $validator->errors();

            $arr_errors = [
                'form_type' => $errors->first('form_type'),
                'content_field' => $errors->first('content_field'),
                'caption_field' => $errors->first('caption_field'),
            ];

        }else{
            $validator = Validator::make($request->all(), [
                'form_type' => ['required'],
                'content_field' => ['required'],
            ], $messages);

            $errors = $validator->errors();

            $arr_errors = [
                'form_type' => $errors->first('form_type'),
                'content_field' => $errors->first('content_field'),
            ];
        }


        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => $arr_errors
            ]);
        }

        // if(in_array($request->form_type, [M_component::ID_M_COMPONENT_IMAGE, M_component::ID_M_COMPONENT_VIDEO])) {

        //     if($request->file('content_field')->getSize() >= 2000000) {
        //         $errors = $validator->errors();
        //         return response()->json([
        //             'error' => [
        //                 'content_field' => $errors->first('content_field'),
        //             ]
        //         ]);
        //     }
        // }

        try{

            DB::beginTransaction();
            $object = new T_content_det();
            $object->id_t_content_det = T_content_det::MaxId();
            $object->id_t_content = $request->id_t_content;

            if(in_array($request->form_type, [M_component::ID_M_COMPONENT_IMAGE, M_component::ID_M_COMPONENT_VIDEO])) {
                $object->value_m_component = $request->caption_field;
                if($request->file('content_field')) {
                    $filename = time() . '_' . $request->file('content_field')->getClientOriginalName();
                    $folder = 'files_content';
                    $f = $folder.'/'.$request->id_t_content;
                    $path = \Storage::disk('public')->putFileAs($f, $request->file('content_field'), $filename);
                    $object->path_t_content_det = $path;
                }
            }else{
                $object->value_m_component = $request->content_field;
            }

            $object->id_m_component = $request->form_type;
            $object->sort_t_content_det = T_content_det::where('id_t_content', $request->id_t_content)->SortData();
            $object->created_at = Carbon::now()->format('Y-m-d H:i:s');

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.t_content.set_content', ['id_t_content' => $request->id_t_content]),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }


    ####################################################################


    public function dynamic_field(Request $request)
    {
        $reinit = false;
        $res = '';
        if(request()->filled('typeform')) {
            switch ($request->typeform) {
                case M_component::ID_M_COMPONENT_IMAGE:
                    $res .= '<div class="mb-1 row">
                                <div class="col-sm-2">
                                    <label class="col-form-label" for="content_m_message">Content</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="file" id="file_upload" name="content_field" class="form-control" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-2">
                                    <label class="col-form-label" for="content_m_message">Caption Content</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" id="caption_field" name="caption_field" class="form-control" />
                                </div>
                            </div>';
                    break;

                case M_component::ID_M_COMPONENT_VIDEO:
                    $res .= '<div class="mb-1 row">
                                <div class="col-sm-2">
                                    <label class="col-form-label" for="content_m_message">Content</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="file" id="file_upload" name="content_field" class="form-control" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-2">
                                    <label class="col-form-label" for="content_m_message">Caption Content</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" id="caption_field" name="caption_field" class="form-control" />
                                </div>
                            </div>';
                    break;

                case M_component::ID_M_COMPONENT_TEXT:
                    $res .= '<div class="mb-1 row">
                                <div class="col-sm-2">
                                    <label class="col-form-label" for="content_m_message">Content</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="content_field"></textarea>
                                </div>
                            </div>';

                    $reinit = true;
                    break;

                // case 'list':
                //     $res .= '<div class="mb-1 row">
                //                 <div class="col-sm-2">
                //                     <label class="col-form-label" for="content_m_message">Content</label>
                //                 </div>
                //                 <div class="col-sm-8">
                //                     <input type="text" class="form-control" name="content_field" value="">
                //                 </div>
                //                 <div class="col-sm-2">
                //                     <button class="button btn btn-sm btn-primary" click="appendList()">+</button>
                //                 </div>
                //             </div>';
                //     break;

                default:
                    $res .= '<div class="mb-1 row">
                                <div class="col-sm-2">
                                    <label class="col-form-label" for="content_m_message">Content</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="content_field">
                                </div>
                            </div>';

                    break;
            }

            $component = M_component::where('id_m_component', $request->typeform)->first();

            return response([
                'status' => true,
                'reinit' => $reinit,
                'html' => $res,
                'style' => ($component) ? $component->default_style_m_component : ''
            ]);
        }else{
            return response([
                'status' => false,
                'reinit' => $reinit,
                'html' => $res,
                'style' => ''
            ]);
        }

        $user_group = M_user_group::where('id_m_app', $request->id_m_app)->get();

        $res = '<option value="">Please choose one</option>';
        foreach ($user_group as $value) {
            $res .= '<option value="' . $value->id_m_user_group . '" >' . $value->nm_user_group . '</option>';
        }
    }

    public function edit_modal_order(Request $request)
    {
        $old = T_content_det::where([
            'id_t_content_det' => $request->id_t_content_det,
        ])->firstOrFail();

        $data = [
            'head_title' => 'Content Data',
            'page_title' => 'Content Data',
            'parent_menu_active' => 'Content Management',
            'child_menu_active'   => 'Content Data',
            'old' => $old,
        ];

        return view('admin.t_content_management.edit_modal_order')->with($data);
    }

    public function edit_modal_content(Request $request)
    {
        $old = T_content_det::where([
            'id_t_content_det' => $request->id_t_content_det,
        ])->firstOrFail();

        $data = [
            'head_title' => 'Content Data',
            'page_title' => 'Content Data',
            'parent_menu_active' => 'Content Management',
            'child_menu_active'   => 'Content Data',
            'old' => $old,
        ];

        return view('admin.t_content_management.edit_modal_content')->with($data);
    }

    public function edit_modal(Request $request)
    {
        $app_data = M_app::IsActive()->orderBy('nm_m_app')->get();
        $menu_data = M_menu::IsActive()->orderBy('nm_menu')->get();

        $old = T_content::where([
            'id_t_content' => $request->id_t_content,
        ])->firstOrFail();

        $data = [
            'head_title' => 'Content Data',
            'page_title' => 'Content Data',
            'parent_menu_active' => 'Content Management',
            'child_menu_active'   => 'Content Data',
            'old' => $old,
            'app_data' => $app_data,
            'menu_data' => $menu_data
        ];


        return view('admin.t_content_management.edit_modal')->with($data);
    }

    public function user_group_modal(Request $request)
    {

        $old = T_content::where([
            'id_t_content' => $request->id_t_content,
        ])->firstOrFail();

        $role = M_user_group::where('id_m_app', $old->id_m_app)->orderBy('nm_user_group')->get();
        $grup_konten = T_group_content::where(['id_m_app' => $old->id_m_app, 'id_t_content' => $old->id_t_content])->get();

        $arr_user_group = $grup_konten->map(function($item) {
            // $item->id_m_user_group;
            return $item->id_m_user_group;
        });

        // dd($arr_user_group);

        $data = [
            'head_title' => 'Content Data',
            'page_title' => 'Content Data',
            'parent_menu_active' => 'Content Management',
            'child_menu_active'   => 'Content Data',
            'old' => $old,
            'role' => $role,
            'arr_user_group' => $arr_user_group
        ];


        return view('admin.t_content_management.user_group_modal')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'id_m_app.required' => 'please choose one',
            // 'id_m_user_group.required' => 'please choose one',
            'id_m_menu.required' => 'please choose one',
            'title_t_content.required' => 'please fill this field',
        ];

        $validator = Validator::make($request->all(), [
            'id_m_app' => ['required'],
            // 'id_m_user_group' => ['required'],
            'id_m_menu' => ['required'],
            'title_t_content' => ['required'],
            'subtitle_t_content' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_m_app' => $errors->first('id_m_app'),
                    // 'id_m_user_group' => $errors->first('id_m_user_group'),
                    'id_m_menu' => $errors->first('id_m_menu'),
                    'title_t_content' => $errors->first('title_t_content'),
                    'subtitle_t_content' => $errors->first('subtitle_t_content'),
                ]
            ]);
        }

        DB::beginTransaction();
        $update = T_content::where([
            'id_t_content' => $request->id_t_content,
        ])->first();

        if($update == null) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_t_content' => 'Data not found !',
                ]
            ]);
        }

        $update->id_m_app = $request->id_m_app;
        $update->id_m_menu = $request->id_m_menu;
        $update->title_t_content = $request->title_t_content;
        $update->subtitle_t_content = $request->subtitle_t_content;
        $update->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Updated',
                'redirect' => route('admin.t_content.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function update_user_group(Request $request)
    {
        $messages = [
            'id_t_content.required' => 'please choose one',
            'id_m_app.required' => 'please choose one',
        ];

        $validator = Validator::make($request->all(), [
            'id_t_content' => ['required'],
            'id_m_app' => ['required'],
        ], $messages);


        DB::beginTransaction();
        try{
            $cek_konten = T_content::where([
                'id_t_content' => $request->id_t_content,
                'id_m_app' => $request->id_m_app,
            ])->first();

            if($cek_konten == null) {
                $errors = $validator->errors();
                return response()->json([
                    'error' => [
                        'id_t_content' => 'Data not found !',
                        'id_m_app' => 'Data not found !',
                    ]
                ]);
            }

            ### delete
            DB::table('t_group_content')->where(['id_m_app' => $cek_konten->id_m_app, 'id_t_content' => $cek_konten->id_t_content])->delete();

            if($request->has('id_m_user_group')) {
                foreach ($request->id_m_user_group as $key => $value) {
                    $object = new T_group_content;
                    $object->id_t_group_content = T_group_content::MaxId();
                    $object->id_t_content = $cek_konten->id_t_content;
                    $object->id_m_user_group = $value;
                    $object->id_m_app = $cek_konten->id_m_app;
                    $object->save();

                    DB::commit();
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'User Group Saved',
                'redirect' => route('admin.t_content.index'),
            ]);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function update_data_order(Request $request)
    {
        $messages = [
            'id_t_content_det.required' => 'please choose one',
            'sort_t_content_det.required' => 'please choose one',
        ];

        $validator = Validator::make($request->all(), [
            'id_t_content_det' => ['required'],
            'sort_t_content_det' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_t_content_det' => $errors->first('id_t_content_det'),
                    'sort_t_content_det' => $errors->first('sort_t_content_det'),
                ]
            ]);
        }

        DB::beginTransaction();
        $update = T_content_det::where([
            'id_t_content_det' => $request->id_t_content_det,
        ])->first();

        if($update == null) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'sort_t_content_det' => 'Data not found !',
                ]
            ]);
        }

        $update->sort_t_content_det = $request->sort_t_content_det;
        $update->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Updated',
                'redirect' => route('admin.t_content.set_content', ['id_t_content' => $update->id_t_content]),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function update_data_content(Request $request)
    {
        // dd($request->all());
        $object = T_content_det::where('id_t_content_det', $request->id_t_content_det)->firstOrFail();

        $messages = ['id_t_content_det.required' => 'please choose one'];

        if(in_array($object->id_m_component, [M_component::ID_M_COMPONENT_IMAGE, M_component::ID_M_COMPONENT_VIDEO])) {
            if($object->id_m_component == M_component::ID_M_COMPONENT_IMAGE) {
                $arr_mimes_valid = ['mimes:png,jpeg,jpg','max:204800'];
            }else{
                $arr_mimes_valid = ['mimes:m4v,avi,flv,mp4,mov','max:204800'];
            }

            $validator = Validator::make($request->all(), [
                'content_field' => $arr_mimes_valid,
                'caption_field' => ['required'],
            ], $messages);

            $errors = $validator->errors();

            $arr_errors = [
                'content_field' => $errors->first('content_field'),
                'caption_field' => $errors->first('caption_field'),
            ];

        }else{
            $validator = Validator::make($request->all(), [
                'content_field' => ['required'],
            ], $messages);

            $errors = $validator->errors();

            $arr_errors = [
                'content_field' => $errors->first('content_field'),
            ];
        }

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => $arr_errors
            ]);
        }

        try{
            DB::beginTransaction();

            if(in_array($object->id_m_component, [M_component::ID_M_COMPONENT_IMAGE, M_component::ID_M_COMPONENT_VIDEO])) {
                $object->value_m_component = $request->caption_field;

                if($request->file('content_field')) {
                    $filename = time() . '_' . $request->file('content_field')->getClientOriginalName();
                    $folder = 'files_content';
                    $f = $folder.'/'.$request->id_t_content;
                    $path = \Storage::disk('public')->putFileAs($f, $request->file('content_field'), $filename);
                    $object->path_t_content_det = $path;
                }

            }else{
                $object->value_m_component = $request->content_field;
            }

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Updated',
                'redirect' => route('admin.t_content.set_content', ['id_t_content' => $object->id_t_content]),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function delete_content_det(Request $request)
    {
        if (!$request->filled('id_t_content_det')) {
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = T_content_det::where([
            'id_t_content_det' => $request->id_t_content_det
        ])->first();

        if ($find == null) {
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        DB::beginTransaction();

        try {
            $find->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.t_content.set_content', ['id_t_content' => $find->id_t_content]),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function delete(Request $request)
    {
        if(!$request->filled('id_t_content')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = T_content::where([
            'id_t_content' => $request->id_t_content
        ])->first();

        if($find == null){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find->is_active_t_content = null;
        $find->deleted_at = Carbon::now()->format('Y-m-d H:i:s');

        DB::beginTransaction();

        try{
            $find->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.t_content.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }


    // public function edit()
    // {
    //     abort_if(!request()->filled('id_m_business') or !is_numeric(request('id_m_business')), 404);

    //     $old = M_business::where([
    //         'id_m_business' => request('id_m_business')
    //     ])->firstOrFail();


    //     $data = [
    //         'head_title' => 'Business',
    //         'page_title' => 'Business',
    //         'parent_menu_active' => 'Master Data',
    //         'child_menu_active'   => 'Business',
    //         'old' => $old,
    //         'id_m_entity'   => M_entity::where('active_m_entity','ACTIVE')->orderBy('nm_m_entity')->get(),
    //         'id_m_business_field'   => M_business_field::where('active_m_business_field','ACTIVE')->orderBy('nm_m_business_field')->get(),
    //         // 'countries'   => M_countries::orderBy('name')->get(),
    //         // 'id_m_branch_status'   => M_branch_status::whereNotNull('active_m_branch_status')->orderBy('nm_m_branch_status')->get(),
    //     ];

    //     return view('admin.m_business.edit')->with($data);
    // }



}
