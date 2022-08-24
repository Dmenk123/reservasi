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
            'id_m_app.required' => 'please choose one',
            // 'id_m_user_group.required' => 'please choose one',
            'id_m_menu.required' => 'please choose one',
            'title_T_reservasi.required' => 'please fill this field',
        ];

        $validator = Validator::make($request->all(), [
            'id_m_app' => ['required'],
            // 'id_m_user_group' => ['required'],
            'id_m_menu' => ['required'],
            'title_T_reservasi' => ['required'],
            'subtitle_T_reservasi' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_m_app' => $errors->first('id_m_app'),
                    // 'id_m_user_group' => $errors->first('id_m_user_group'),
                    'id_m_menu' => $errors->first('id_m_menu'),
                    'title_T_reservasi' => $errors->first('title_T_reservasi'),
                    'subtitle_T_reservasi' => $errors->first('subtitle_T_reservasi'),
                ]
            ]);
        }

        DB::beginTransaction();
        $update = T_reservasi::where([
            'id_T_reservasi' => $request->id_T_reservasi,
        ])->first();

        if($update == null) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'id_T_reservasi' => 'Data not found !',
                ]
            ]);
        }

        $update->id_m_app = $request->id_m_app;
        $update->id_m_menu = $request->id_m_menu;
        $update->title_T_reservasi = $request->title_T_reservasi;
        $update->subtitle_T_reservasi = $request->subtitle_T_reservasi;
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


    public function verifikasi_modal(Request $request)
    {
        $query = T_reservasi::with(['t_file_upload'])->firstOrFail();
        $data = [
            'head_title' => 'Reservasi',
            'page_title' => 'Reservasi',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Reservasi',
            'old' => $query,
        ];

        // dd($data);

        return view('admin.t_jadwal_rutin.verifikasi_modal')->with($data);
    }

    public function verifikasi(Request $request)
    {
        // dd($request->all());
        if(request()->filled('id_t_reservasi') && request()->filled('verifikasi_transaksi')) {
            $cek = T_reservasi::where('id_t_reservasi', $request->id_t_reservasi)->first();

            if(!$cek) {
                return response()->json([
                    'message' => 'Transaksi tidak ditemukan',
                    'status'  => false,
                ]);
            }


            DB::beginTransaction();

            $cek->verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $cek->verified_by = session()->get('logged_in.id_m_user_bo');
            $cek->id_m_proses = M_proses::ID_M_PROSES_VERIFIKASI_PEMBAYARAN;
            $cek->updated_at = Carbon::now()->format('Y-m-d H:i:s');

            ### proses
            $proses = new T_log_proses;
            $proses->id_t_log_proses = T_log_proses::MaxId();
            $proses->id_t_reservasi = $request->id_t_reservasi;
            $proses->id_m_proses = M_proses::ID_M_PROSES_VERIFIKASI_PEMBAYARAN;
            $proses->created_at = Carbon::now()->format('Y-m-d H:i:s');

            try{

                $cek->save();
                $proses->save();

                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Data Saved',
                    'redirect' => route('admin.t_jadwal_rutin.index'),
                ]);
            }catch(\Exception $e){
                DB::rollback();
                return response()->json([
                    'message' => $e->getMessage(),
                    'status'  => false,
                ]);
            }

        }else{
            return response()->json([
                'message' => 'Belum melakukan verifikasi (ceklis)',
                'status'  => false,
            ]);
        }

    }


}
