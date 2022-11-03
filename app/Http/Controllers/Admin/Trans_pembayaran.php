<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\M_proses;
use App\Models\M_interval;
use App\Models\T_reservasi;
use App\Models\T_log_proses;
use App\Models\T_pembayaran;
use Illuminate\Http\Request;
use App\Models\T_jadwal_rutin;
use App\Models\T_group_content;
use App\Models\T_pembayaran_det;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class Trans_pembayaran extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'Pembayaran',
            'page_title' => 'Pembayaran',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Pembayaran',
        ];

        return view('admin.t_pembayaran.index')->with($data);
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = T_pembayaran::with(['t_reservasi', 't_pembayaran_det'])->whereNull('tgl_pelunasan_t_pembayaran')->orderByDesc('created_at')->get();
            // dd($query);
            $data  = [];
            foreach ($query as $key => $val) {
                // dd($val, $val->id_t_reservasi, $val->m_proses->nm_m_proses);
                $obj = new \stdClass;
                // $obj->no = $key+1;
                $obj->id_t_pembayaran = $val->id_t_pembayaran;
                $obj->id_t_reservasi = $val->id_t_reservasi;
                $obj->kode_t_reservasi = $val->t_reservasi->kode_t_reservasi;
                $obj->nilai_t_pembayaran = ($val->nilai_t_pembayaran) ? number_format($val->nilai_t_pembayaran,0,',','.') : 0;
                $obj->jenis_t_pembayaran = $val->jenis_t_pembayaran;
                $obj->balance_t_pembayaran = ($val->balance_t_pembayaran) ? number_format($val->balance_t_pembayaran,0,',','.') : 0;
                $obj->nominal_cicilan_t_pembayaran = ($val->nominal_cicilan_t_pembayaran) ? number_format($val->nominal_cicilan_t_pembayaran,0,',','.') : 0;
                $obj->durasi_cicilan_t_pembayaran = $val->durasi_cicilan_t_pembayaran;
                $obj->cicilan_ke_t_pembayaran = $val->cicilan_ke_t_pembayaran;
                $obj->nominal_total_t_pembayaran = ($val->nominal_total_t_pembayaran) ? number_format($val->nominal_total_t_pembayaran,0,',','.') : 0;
                $obj->tgl_pelunasan_t_pembayaran = ($val->tgl_pelunasan_t_pembayaran) ? Carbon::parse($val->tgl_pelunasan_t_pembayaran)->format('d-m-Y') : '';
                ### wajib menggunakan nama object action
                if($val->balance_t_pembayaran == '0' && $val->tgl_pelunasan_t_pembayaran == null) {
                    $obj->action = '<div class="btn-group">
                        <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                        actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                            <a class="dropdown-item detail" data-id_t_pembayaran="'.$val->id_t_pembayaran.'" href="javascript:void(0)">Detail</a>
                            <a class="dropdown-item transaksi-selesai" data-id_t_pembayaran="'.$val->id_t_pembayaran.'" href="javascript:void(0)">Set as Finish</a>
                        </div>
                    </div>';
                }else{
                    $obj->action = '<div class="btn-group">
                        <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                        actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                            <a class="dropdown-item detail" data-id_t_pembayaran="'.$val->id_t_pembayaran.'" href="javascript:void(0)">Detail</a>
                        </div>
                    </div>';
                }

                // $val->created_at = Carbon::now();
                // $val->updated_at = Carbon::now();
                $data[] = $obj;
            }

            // dd($data);

            $datatable = new Collection($data);

            return Datatables::of($datatable)->addIndexColumn()->rawColumns(['action'])->make(true);
        }
    }

    public function detail_modal(Request $request)
    {
        if(!$request->filled('id_t_pembayaran')) {
            return response()->json([
                'status' => false,
            ]);
        }

        $query = T_pembayaran::with(['t_reservasi', 't_pembayaran_det'])->where('id_t_pembayaran', $request->id_t_pembayaran)->firstOrFail();

        $data = [
            'old' => $query,
        ];

        // dd($query);

        return view('admin.t_pembayaran.detail_modal')->with($data);
    }

    public function bukti_pembayaran_modal(Request $request)
    {
        if(!$request->filled('id_t_pembayaran_det')) {
            return response()->json([
                'status' => false,
            ]);
        }

        $query = T_pembayaran_det::with(['t_reservasi_det'])->where('id_t_pembayaran_det', $request->id_t_pembayaran_det)->firstOrFail();

        $data = [
            'old' => $query,
        ];

        // dd($query);

        return view('admin.t_pembayaran.bukti_pembayaran_modal')->with($data);
    }

    public function edit_modal(Request $request)
    {
        $query = T_jadwal_rutin::with(['m_interval'])->firstOrFail();
        $data = [
            'head_title' => 'Pembayaran',
            'page_title' => 'Pembayaran',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Pembayaran',
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

        return view('admin.t_pembayaran.edit_modal')->with($data);
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
                'redirect' => route('admin.t_pembayaran.index'),
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

        return view('admin.t_pembayaran.verifikasi_modal')->with($data);
    }

    public function transaksi_selesai(Request $request)
    {
        // dd($request->all());
        if(request()->filled('id_t_pembayaran')) {
            $cek = T_pembayaran::where('id_t_pembayaran', $request->id_t_pembayaran)->first();

            if(!$cek) {
                return response()->json([
                    'message' => 'Transaksi tidak ditemukan',
                    'status'  => false,
                ]);
            }


            DB::beginTransaction();

            ### update pembayaran
            $cek->tgl_pelunasan_t_pembayaran = Carbon::now()->format('Y-m-d');
            $cek->updated_at = Carbon::now()->format('Y-m-d H:i:s');

            ### update reservasi
            ### set proses
            $reservasi = T_reservasi::where('id_t_reservasi', $cek->id_t_reservasi)->first();
            if(!$reservasi) {
                return response()->json([
                    'message' => 'Reservasi tidak ditemukan',
                    'status'  => false,
                ]);
            }

            $reservasi->id_m_proses = M_proses::ID_M_PROSES_TRANSAKSI_SELESAI;
            $reservasi->updated_at = Carbon::now()->format('Y-m-d H:i:s');

            ### proses
            $proses = new T_log_proses;
            $proses->id_t_log_proses = T_log_proses::MaxId();
            $proses->id_t_reservasi = $cek->id_t_reservasi;
            $proses->id_m_proses = M_proses::ID_M_PROSES_TRANSAKSI_SELESAI;
            $proses->created_at = Carbon::now()->format('Y-m-d H:i:s');

            try{

                $cek->save();
                $reservasi->save();
                $proses->save();

                DB::commit();

                $email = new MailController;
                ### send email
                $send_email = $email->send_email_link_upload(trim($reservasi->email_t_reservasi), $reservasi);

                return response()->json([
                    'status' => true,
                    'message' => 'Data Saved',
                    // 'redirect' => route('admin.t_pembayaran.index'),
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
                'message' => 'Invalid data',
                'status'  => false,
            ]);
        }

    }


}
