<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\M_user_group_bo;
use App\Models\M_menu_bo;
use App\Models\M_harga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class Master_harga extends Controller
{
    public function index()
    {
        $data = [
            'head_title' => 'Harga',
            'page_title' => 'Harga',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Harga',
        ];

        return view('admin.m_harga.index')->with($data);
    }

    public function datatable(Request $request)
    {

        $table = M_harga::orderByDesc('id_m_harga')->get();

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

    		$datas[$key][] = $i++;
            $datas[$key][] = '<div style="text-align:right;">' . number_format($value->nominal_m_harga, 0, ',', '.') . '</div>';
            $datas[$key][] = '<div style="text-align:right;">' . number_format($value->nominal_cicilan, 0, ',', '.') . '</div>';
            $datas[$key][] = '<div style="text-align:right;">' . $value->jangka_cicilan . '</div>';
            $datas[$key][] = ($value->status_m_harga == '1') ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y H:i:s');
            $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item" href="'.route('admin.m_harga.edit',['id_m_harga' => $value->id_m_harga]).'">edit</a>
                                        <a class="dropdown-item nonActive" data-id_m_harga="'.$value->id_m_harga.'" href="#">Non Active</a>
                                    </div>
                                </div>';
    	}

    	$data = [
    		'data' => $datas
    	];

    	return response()->json($data);
    }

    public function add()
    {
        $data = [
            'head_title' => 'Harga',
            'page_title' => 'Harga',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Harga',
        ];

    	return view('admin.m_harga.add')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            'nominal.required' => 'please fill out this field',
            'cicilan.required' => 'please fill out this field',
            'jangka.required' => 'please fill out this field',
            'aktif.required' => 'please fill out this field',
        ];

        $validator = Validator::make($request->all(), [
            'nominal' => ['required'],
            'cicilan' => ['required'],
            'jangka' => ['required'],
            'aktif' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nominal' => $errors->first('nominal'),
                    'cicilan' => $errors->first('nominal'),
                    'jangka' => $errors->first('nominal'),
                    'aktif' => $errors->first('aktif'),
                ]
            ]);
        }


        DB::beginTransaction();
        $object = new M_harga;
        $object->id_m_harga = M_harga::MaxId();
        $object->status_m_harga = ($request->aktif == '1') ? '1' : null;
        $object->nominal_m_harga = (int)str_replace(".", "", $request->nominal);
        $object->nominal_cicilan = (int)str_replace(".", "", $request->cicilan);
        $object->jangka_cicilan = (int)$request->jangka;

        try{
            if($request->aktif == '1') {
                $cek = M_harga::where([
                    'status_m_harga' => '1',
                ])->first();

                if($cek) {
                    $cek->status_m_harga = null;
                    $cek->save();
                }
            }

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_harga.index'),
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
        abort_if(!request()->filled('id_m_harga') or !is_numeric(request('id_m_harga')), 404);

        $old = M_harga::where([
            'id_m_harga' => request('id_m_harga')
        ])->firstOrFail();


        $data = [
            'head_title' => 'Harga',
            'page_title' => 'Harga',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Harga',
            'old' => $old,
        ];

        return view('admin.m_harga.edit')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'nominal.required' => 'please fill out this field',
            'cicilan.required' => 'please fill out this field',
            'jangka.required' => 'please fill out this field',
            'aktif.required' => 'please fill out this field',
        ];

        $validator = Validator::make($request->all(), [
            'nominal' => ['required'],
            'cicilan' => ['required'],
            'jangka' => ['required'],
            'aktif' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nominal' => $errors->first('nominal'),
                    'cicilan' => $errors->first('cicilan'),
                    'jangka' => $errors->first('jangka'),
                    'aktif' => $errors->first('aktif'),
                ]
            ]);
        }


        DB::beginTransaction();
        $update = M_harga::where([
            'id_m_harga' => $request->id_m_harga,
        ])->first();

        if($update == null)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nominal' => 'Data not found !',
                ]
            ]);
        }

        $update->status_m_harga = ($request->aktif == '1') ? '1' : null;
        $update->nominal_m_harga = (int)str_replace(".", "", $request->nominal);

        try{
            if($request->aktif == '1') {
                $cek = M_harga::where([
                    'status_m_harga' => '1',
                ])->first();

                if($cek) {
                    $cek->status_m_harga = null;
                    $cek->save();
                }
            }

            $update->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_harga.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }

    public function nonaktif(Request $request)
    {
        if(!$request->filled('id_m_harga')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = M_harga::where([
            'id_m_harga' => $request->id_m_harga
        ])->first();

        if($find==null){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        DB::beginTransaction();

        try{
            $find->status_m_harga = null;
            $find->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.m_harga.index'),
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
