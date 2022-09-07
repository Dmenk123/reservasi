<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\M_proses;
use App\Models\T_log_proses;
use App\Models\T_reservasi;
use App\Models\M_user_group;
use Illuminate\Http\Request;
use App\Models\T_group_content;
use App\Models\T_reservasi_det;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\T_pembayaran;
use App\Models\T_pembayaran_det;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Datatables\Datatables;

class T_reservasi_controller extends Controller
{

    public function index()
    {
        $proses = M_proses::whereNotIn('id_m_proses', [M_proses::ID_M_PROSES_KONFIRMASI_PEMBAYARAN])->orderBy('urut_m_proses')->get();

        $data = [
            'head_title' => 'Reservasi',
            'page_title' => 'Reservasi',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Reservasi',
            'proses' => $proses
        ];

        return view('admin.t_reservasi.index')->with($data);
    }

    public function datatable(Request $request)
    {
        $month = $request->month ?? null;
        $year = $request->year ?? null;
        $proses = $request->proses ?? null;
        $metode_bayar = $request->metode_bayar ?? null;

        if ($request->ajax()) {
            $query = T_reservasi::with(['m_proses' => function($q) {
                            $q->whereNotIn("id_m_proses", [M_proses::ID_M_PROSES_KONFIRMASI_PEMBAYARAN]);
                        }])
                        ->when($month, function ($q, $month) {
                            return $q->whereMonth('tanggal_t_reservasi', '=', $month);
                        })
                        ->when($year, function ($q, $year) {
                            return $q->whereYear('tanggal_t_reservasi', '=', $year);
                        })
                        ->when($proses, function ($q, $proses) {
                            return $q->where('id_m_proses', $proses);
                        })
                        ->when($metode_bayar, function ($q, $metode_bayar) {
                            return $q->where('metode_pembayaran_t_reservasi', $metode_bayar);
                        })
                        ->whereNotIn("id_m_proses", [M_proses::ID_M_PROSES_KONFIRMASI_PEMBAYARAN])
                        ->orderByDesc('created_at')->get();
            $data  = [];
            foreach ($query as $key => $val) {
                // dd($val, $val->id_t_reservasi, $val->m_proses->nm_m_proses);
                $obj = new \stdClass;
                // $obj->no = $key+1;
                $obj->id_t_reservasi = $val->id_t_reservasi;
                $obj->nm_t_reservasi = $val->nm_t_reservasi;
                $obj->email_t_reservasi = $val->email_reservasi;
                $obj->kode_t_reservasi = $val->kode_t_reservasi;
                $obj->telp_t_reservasi = $val->telp_t_reservasi;
                $obj->nm_m_proses = $val->m_proses->nm_m_proses;
                $obj->tgl_t_reservasi = $val->hari_t_reservasi.' / '.Carbon::parse($val->tanggal_t_reservasi)->format('d-m-Y');
                $obj->jam_t_reservasi = Carbon::parse($val->jam_t_reservasi)->format('H:i');
                $obj->jenis_t_reservasi = $val->jenis_t_reservasi;
                $obj->metode_pembayaran_t_reservasi = $val->metode_pembayaran_t_reservasi;
                $obj->kode_payment_t_reservasi = $val->kode_payment_t_reservasi;
                ### wajib menggunakan nama object action
                if($val->id_m_proses == M_proses::ID_M_PROSES_PEMBAYARAN) {
                    $str_aksi = '
                        <a class="dropdown-item detail" data-id_t_reservasi="'.$val->id_t_reservasi.'" href="javascript:void(0)">View Detail</a>
                        <a class="dropdown-item verifikasi" data-id_t_reservasi="'.$val->id_t_reservasi.'" href="javascript:void(0)">Verifikasi</a>
                    ';
                }else{
                    $str_aksi = '
                        <a class="dropdown-item detail" data-id_t_reservasi="'.$val->id_t_reservasi.'" href="javascript:void(0)">View Detail</a>
                    ';
                }


                $obj->action = '<div class="btn-group">
                                <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                    '.$str_aksi.'
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

    public function detail_modal(Request $request)
    {
        $query = T_reservasi::with(['m_proses'])->firstOrFail();
        $data = [
            'head_title' => 'Reservasi',
            'page_title' => 'Reservasi',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Reservasi',
            'old' => $query,
        ];

        return view('admin.t_reservasi.detail_modal')->with($data);
    }

    public function verifikasi_modal(Request $request)
    {
        $query = T_reservasi::with(['t_reservasi_det' => function($q) use($request){
            $q->whereNull("verified_by");
        }])->where('id_t_reservasi', $request->id_t_reservasi)->first();
        // $det = DB::table('t_reservasi_det')->where('kode_t_reservasi', $query->kode_t_reservasi)->first();
        // dd($det);
        $data = [
            'head_title' => 'Reservasi',
            'page_title' => 'Reservasi',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Reservasi',
            'old' => $query,
        ];

        // dd($data);

        return view('admin.t_reservasi.verifikasi_modal')->with($data);
    }

    public function verifikasi(Request $request)
    {
        // dd($request->all());
        try{
            if(request()->filled('id_t_reservasi') && request()->filled('verifikasi_transaksi')) {

                if(request()->has('verify') == false) {
                    return response()->json([
                        'message' => 'Mohon ceklist salah satu pembayaran',
                        'status'  => false,
                    ]);
                }

                $header = T_reservasi::where('id_t_reservasi', $request->id_t_reservasi)->first();

                if(!$header) {
                    return response()->json([
                        'message' => 'Reservasi tidak ditemukan',
                        'status'  => false,
                    ]);
                }

                ### cek exist pembayaran
                $cek_bayar = T_pembayaran::where('id_t_reservasi', $request->id_t_reservasi)->first();

                DB::beginTransaction();
                if(!$cek_bayar) {
                    #### new data
                    $objBayar = new T_pembayaran;
                    $id_t_pembayaran = T_pembayaran::MaxId();

                    $objBayar->id_t_pembayaran = $id_t_pembayaran;
                    $objBayar->id_t_reservasi =  $header->id_t_reservasi;
                    $objBayar->nilai_t_pembayaran =  $header->nominal_total;
                    $objBayar->jenis_t_pembayaran = $header->jenis_t_reservasi;
                    $objBayar->balance_t_pembayaran = $header->nominal_total;

                    if($header->jenis_t_reservasi != 'cash') {
                        $objBayar->nominal_cicilan_t_pembayaran = 0;
                        $objBayar->durasi_cicilan_t_pembayaran = 0;
                        $objBayar->cicilan_ke_t_pembayaran = 0;
                    }

                    $objBayar->nominal_total_t_pembayaran = 0;
                    $objBayar->created_at = Carbon::now()->format('Y-m-d H:i:s');

                    $objBayar->save();
                    // DB::commit();
                }else{
                    $id_t_pembayaran = $cek_bayar->id_t_pembayaran;
                }

                $nominal_total_t_pembayaran = 0;

                foreach ($request->verify as $key => $value) {
                    // $cek = T_reservasi::with(['t_reservasi_det' => function($q) use($value){
                    //     $q->where("id_t_reservasi_det", $value);
                    // }])->where('id_t_reservasi', $request->id_t_reservasi)->first();
                    $cek = T_reservasi_det::where('id_t_reservasi_det', $value)->first();

                    if(!$cek) {
                        return response()->json([
                            'message' => 'Transaksi tidak ditemukan',
                            'status'  => false,
                        ]);
                    }

                    $nominal_total_t_pembayaran += $cek->nominal;
                    $kode_konfirmasi = 'CFRM-'.$this->random();
                    ### PEMBAYARAN DET
                    $pembayaran_det = T_pembayaran_det::create([
                        'id_t_pembayaran' => $id_t_pembayaran,
                        'nominal_t_pembayaran_det' => $cek->nominal,
                        'kode_konfirmasi' => $kode_konfirmasi,
                        'tgl_t_pembayaran_det' => Carbon::now()->format('Y-m-d'),
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                    $cek->verified_at = Carbon::now()->format('Y-m-d H:i:s');
                    $cek->verified_by = session()->get('logged_in.id_m_user_bo');
                    $cek->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                    $cek->kode_konfirmasi = $kode_konfirmasi;
                    $cek->save();
                    // DB::commit();
                }

                ### get last record pembayaran
                $cek_bayar_final = T_pembayaran::where('id_t_pembayaran', $id_t_pembayaran)->first();
                if(!$cek_bayar_final) {
                    DB::rollback();
                    return response()->json([
                        'message' => 'Transaksi Gagal',
                        'status'  => false,
                    ]);
                }

                $last_balance = $cek_bayar_final->balance_t_pembayaran;
                $balance = $nominal_total_t_pembayaran - $last_balance;

                // if((int)$balance == 0) {
                //     $cek_bayar_final->tgl_pelunasan_t_pembayaran = Carbon::now()->format('Y-m-d');
                // }

                $cek_bayar_final->nominal_total_t_pembayaran = $nominal_total_t_pembayaran;
                $cek_bayar_final->balance_t_pembayaran = $balance;
                $cek_bayar_final->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $cek_bayar_final->save();

                ### update header
                $header->id_m_proses = M_proses::ID_M_PROSES_KONFIRMASI_PEMBAYARAN;
                $header->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $header->save();

                ### proses
                $proses = new T_log_proses;
                $proses->id_t_log_proses = T_log_proses::MaxId();
                $proses->id_t_reservasi = $request->id_t_reservasi;
                $proses->id_m_proses = M_proses::ID_M_PROSES_KONFIRMASI_PEMBAYARAN;
                $proses->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $proses->save();

                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Data Saved',
                    'redirect' => route('admin.t_reservasi.index'),
                ]);

            }else{
                return response()->json([
                    'message' => 'Belum melakukan verifikasi (ceklis)',
                    'status'  => false,
                ]);
            }
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }

    public function random()
    {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand =  substr(str_shuffle(str_repeat($pool, 5)), 0, 16);

        return $rand;
    }

    //////////////////////////////////////////

}
