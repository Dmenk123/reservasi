<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\M_interval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class Master_interval extends Controller
{
    public function index()
    {
        $data = [
            'head_title' => 'Interval',
            'page_title' => 'Interval',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Interval',
        ];

        return view('admin.m_interval.index')->with($data);
    }

    public function datatable(Request $request)
    {

        $table = M_interval::orderByDesc('id_m_interval')->get();

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

    		$datas[$key][] = $i++;
            $datas[$key][] = $value->durasi_m_interval;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y H:i:s');
            $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item" href="'.route('admin.m_interval.edit',['id_m_interval' => $value->id_m_interval]).'">edit</a>
                                        <a class="dropdown-item delete" data-id_m_interval="'.$value->id_m_interval.'" href="#">hapus</a>
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
            'head_title' => 'Interval',
            'page_title' => 'Interval',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Interval',
        ];

    	return view('admin.m_interval.add')->with($data);
    }

    public function save(Request $request)
    {
        $messages = [
            'durasi.required' => 'please fill out this field',
            'durasi.numeric' => 'please fill number only',
        ];

        $validator = Validator::make($request->all(), [
            'durasi' => ['required', 'numeric'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'durasi' => $errors->first('durasi'),
                ]
            ]);
        }

        $cek = m_interval::where([
            'durasi_m_interval' => $request->durasi,
        ])->first();

        if($cek)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'durasi' => 'Durasi sudah ada',
                ]
            ]);
        }


        DB::beginTransaction();
        $object = new m_interval;
        $object->id_m_interval = m_interval::MaxId();
        $object->durasi_m_interval = $request->durasi;

        try{
            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_interval.index'),
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
        abort_if(!request()->filled('id_m_interval') or !is_numeric(request('id_m_interval')), 404);

        $old = m_interval::where([
            'id_m_interval' => request('id_m_interval')
        ])->firstOrFail();


        $data = [
            'head_title' => 'Interval',
            'page_title' => 'Interval',
            'parent_menu_active' => 'Master Data',
            'child_menu_active'   => 'Interval',
            'old' => $old,
        ];

        return view('admin.m_interval.edit')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'durasi.required' => 'please fill out this field',
            'durasi.numeric' => 'please fill number only',
        ];

        $validator = Validator::make($request->all(), [
            'durasi' => ['required', 'numeric'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'durasi' => $errors->first('durasi'),
                ]
            ]);
        }


        DB::beginTransaction();

        $cek = m_interval::where([
            'durasi_m_interval' => $request->durasi,
        ])->first();

        if($cek)
        {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'durasi' => 'Durasi sudah ada',
                ]
            ]);
        }

        $update = m_interval::where([
            'id_m_interval' => $request->id_m_interval,
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

        $update->durasi_m_interval = $request->durasi;

        try{
            $update->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'redirect' => route('admin.m_interval.index'),
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
        if(!$request->filled('id_m_interval')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = m_interval::where([
            'id_m_interval' => $request->id_m_interval
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
                'redirect' => route('admin.m_interval.index'),
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
