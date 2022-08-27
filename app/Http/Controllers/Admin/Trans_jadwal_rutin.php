<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\M_proses;
use App\Models\T_log_proses;
use App\Models\T_reservasi;
use App\Models\M_interval;
use Illuminate\Http\Request;
use App\Models\T_group_content;
use App\Models\T_reservasi_det;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\T_jadwal_rutin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Datatables\Datatables;

class Trans_jadwal_rutin extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'Jadwal Rutin',
            'page_title' => 'Jadwal Rutin',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Jadwal Rutin',
        ];

        return view('admin.t_jadwal_rutin.index')->with($data);
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = T_jadwal_rutin::with(['m_interval'])->orderByDesc('urut_t_jadwal_rutin')->get();
            $data  = [];
            foreach ($query as $key => $val) {
                // dd($val, $val->id_t_reservasi, $val->m_proses->nm_m_proses);
                $obj = new \stdClass;
                // $obj->no = $key+1;
                $obj->id_t_jadwal_rutin = $val->id_t_jadwal_rutin;
                $obj->id_m_interval = $val->id_m_interval;
                $obj->durasi_m_interal = $val->m_interval->durasi_m_interval.' jam';
                $obj->jam_mulai = $val->jam_mulai;
                $obj->jam_akhir = $val->jam_akhir;
                $obj->hari = $val->hari;
                $obj->status = $val->status;
                $obj->created_at = Carbon::parse($val->created_at)->format('d-m-Y');
                ### wajib menggunakan nama object action
                $obj->action = '<div class="btn-group">
                                <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                    <a class="dropdown-item edit" data-id_t_jadwal_rutin="'.$val->id_t_jadwal_rutin.'" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>';
                // $val->created_at = Carbon::now();
                // $val->updated_at = Carbon::now();
                $data[] = $obj;
            }

            // dd($data);

            $datatable = new Collection($data);

            return Datatables::of($datatable)->addIndexColumn()->rawColumns(['action'])->make(true);
        }
    }

    public function edit_modal(Request $request)
    {
        $query = T_jadwal_rutin::with(['m_interval'])->firstOrFail();
        $data = [
            'head_title' => 'Jadwal Rutin',
            'page_title' => 'Jadwal Rutin',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Jadwal Rutin',
            'interval' => M_interval::get(),
            'old' => $query,
            'arr_hari' => [
                1 => 'senin',
                2 => 'selasa',
                3 => 'rabu',
                4 => 'kamis',
                5 => 'jumat',
                6 => 'sabtu',
                7 => 'minggu'
            ]
        ];

        return view('admin.t_jadwal_rutin.edit_modal')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            // 'hari.required' => 'please choose one',
            'jam_mulai.required' => 'please choose one',
            'jam_akhir.required' => 'please fill this field',
        ];

        $validator = Validator::make($request->all(), [
            // 'hari' => ['required'],
            'jam_mulai' => ['required'],
            'jam_akhir' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    // 'hari' => $errors->first('hari'),
                    'jam_mulai' => $errors->first('jam_mulai'),
                    'jam_akhir' => $errors->first('jam_akhir'),
                ]
            ]);
        }

        DB::beginTransaction();
        $update = T_jadwal_rutin::where([
            'id_t_jadwal_rutin' => $request->id_t_jadwal_rutin,
        ])->first();

        if($update == null) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_t_jadwal_rutin' => 'Data not found !',
                ]
            ]);
        }

        $update->jam_mulai = $request->jam_mulai.':00';
        $update->jam_akhir = $request->jam_akhir.':00';
        $update->id_m_interval = $request->id_m_interval;
        $update->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Updated',
                'redirect' => route('admin.t_jadwal_rutin.index'),
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
