<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Admin\Report\Exports\T_riwayat_kesehatan_export;
use App\Http\Controllers\Admin\Report\Exports\T_sds_export;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\M_branch;
use App\Models\M_mcu_category;
use App\Models\M_mcu_category_det;
use App\Models\M_menu;
use App\Models\T_riwayat_kesehatan;
use App\Models\T_riwayat_kesehatan_det;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class Report_form_rk extends Controller
{
    public $menu, $parent;

    public function __construct()
    {
        $this->menu = M_menu::where('id_m_menu', request()->get('menu'))->first();
        $this->parent = M_menu::where('id_m_menu', $this->menu->id_parent)->first();
    }

    public function index()
    {
        $data = [
            'head_title' => $this->menu->nm_menu,
            'page_title' => $this->menu->nm_menu,
            'parent_menu_active' => $this->parent->nm_menu,
            'child_menu_active'   => $this->menu->nm_menu,
        ];

        return view('admin.report.r_form_rk.index')->with($data);
    }

    public function datatable(Request $request)
    {
        $table = T_riwayat_kesehatan::orderBy('id_t_riwayat_kesehatan')->get();
        // dd($table);
        $datas = [];
        $i = 1;
        foreach ($table as $key => $value) {
            // dump($value->tanggal_t_riwayat_kesehatan);
            $datas[$key][] = $i++;
            $datas[$key][] = $value->no_reg_t_riwayat_kesehatan;
            $datas[$key][] = $value->nama_t_riwayat_kesehatan;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d', $value->tanggal_periksa_t_riwayat_kesehatan)->format('d-m-Y');
            $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto  auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item view_info" data-id_t_riwayat_kesehatan="' . $value->id_t_riwayat_kesehatan . '" href="#">Submittee Info</a>
                                        <a class="dropdown-item view_ans" data-id_t_riwayat_kesehatan="' . $value->id_t_riwayat_kesehatan . '" href="#">Medical History Answer</a>
                                    </div>
                                </div>';
        }

        $data = [
            'data' => $datas
        ];

        return response()->json($data);
    }

    //t_sds_det-----------------------------------------------------------------------------------------------------------
    public function view_ans(Request $request)
    {
        $t_riwayat_kesehatan = T_riwayat_kesehatan::orderBy('id_t_riwayat_kesehatan')
            ->where('id_t_riwayat_kesehatan', $request->id_t_riwayat_kesehatan)
            ->first();

        $data = [
            'head_title' => $this->menu->nm_menu,
            'page_title' => 'Medical History Response',
            'parent_menu_active' => $this->parent->nm_menu,
            'child_menu_active'   => $this->menu->nm_menu,
            't_riwayat_kesehatan' => $t_riwayat_kesehatan,
        ];

        return view('admin.report.r_form_rk.view_ans')->with($data);
    }

    public function dt_ans(Request $request)
    {
        // dd($request->id_t_sds);
        $table = T_riwayat_kesehatan_det::orderBy('id_t_riwayat_kesehatan_det')
            ->with('t_riwayat_kesehatan','m_keluhan','m_konsumsi_obat','m_riwayat_penyakit.m_jenis_penyakit','m_penyakit_keluarga', 'm_kebiasaan_hidup')
            ->where('id_t_riwayat_kesehatan', $request->id_t_riwayat_kesehatan)
            ->get();
        // dd($table);
        $datas = [];
        $i = 1;
        foreach ($table as $key => $value) {

            if ($value->id_m_keluhan!=null) {
                $datas[$key][] = $i++;
                $datas[$key][] = "Keluhan saat ini";
                $datas[$key][] = $value->m_keluhan->nm_m_keluhan;
                $datas[$key][] = (
                    $value->ans_t_riwayat_kesehatan_det==1?"YA":(
                        $value->ans_t_riwayat_kesehatan_det==2?"TIDAK":$value->ans_t_riwayat_kesehatan_det
                    )
                );
            }
            if ($value->id_m_riwayat_penyakit != null) {
                $datas[$key][] = $i++;
                $datas[$key][] = "Riwayat penyakit [" . $value->m_riwayat_penyakit->m_jenis_penyakit->nm_m_jenis_penyakit . "]";
                $datas[$key][] = $value->m_riwayat_penyakit->nm_m_riwayat_penyakit;

                $datas[$key][] = (
                    $value->ans_t_riwayat_kesehatan_det==1?"YA":(
                        $value->ans_t_riwayat_kesehatan_det==2?"TIDAK":$value->ans_t_riwayat_kesehatan_det
                    )
                );
            }
            if ($value->id_m_penyakit_keluarga != null) {
                $datas[$key][] = $i++;
                $datas[$key][] = "Riwayat penyakit keluarga";
                $datas[$key][] = $value->m_penyakit_keluarga->nm_m_penyakit_keluarga;

                $datas[$key][] = (
                    $value->ans_t_riwayat_kesehatan_det==1?"YA":(
                        $value->ans_t_riwayat_kesehatan_det==2?"TIDAK":$value->ans_t_riwayat_kesehatan_det
                    )
                );
            }
            if ($value->id_m_kebiasaan_hidup != null) {
                $datas[$key][] = $i++;
                $datas[$key][] = "Riwayat kebiasaan hidup";
                $datas[$key][] = $value->m_kebiasaan_hidup->nm_m_kebiasaan_hidup;

                $datas[$key][] = (
                    $value->ans_t_riwayat_kesehatan_det==1?"YA":(
                        $value->ans_t_riwayat_kesehatan_det==2?"TIDAK":$value->ans_t_riwayat_kesehatan_det
                    )
                );
            }
            if ($value->id_m_konsumsi_obat != null) {
                $datas[$key][] = $i++;
                $datas[$key][] = "Riwayat konsumsi obat";
                $datas[$key][] = $value->m_konsumsi_obat->nm_m_konsumsi_obat;

                $datas[$key][] = (
                    $value->ans_t_riwayat_kesehatan_det==1?"YA":(
                        $value->ans_t_riwayat_kesehatan_det==2?"TIDAK":$value->ans_t_riwayat_kesehatan_det
                    )
                );
            }
            // $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d', $value->tanggal_t_sds)->format('d-m-Y');
            // $datas[$key][] = '<div class="btn-group">
            //                         <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
            //                         actions
            //                         </button>
            //                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto  auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
            //                             <a class="dropdown-item view_info" data-id_t_sds="' . $value->id_t_sds . '" href="#">Submittee Info</a>
            //                             <a class="dropdown-item view_ans" data-id_t_sds="' . $value->id_t_sds . '" href="#">SDS Response</a>
            //                         </div>
            //                     </div>';
        }

        $data = [
            'data' => $datas
        ];

        return response()->json($data);
    }

    public function view_info(Request $request)
    {
        $t_riwayat_kesehatan = T_riwayat_kesehatan::orderBy('id_t_riwayat_kesehatan')
        ->where('id_t_riwayat_kesehatan', $request->id_t_riwayat_kesehatan)
            ->first();

        $data = [
            'head_title' => $this->menu->nm_menu,
            'page_title' => 'Medical History Response',
            'parent_menu_active' => $this->parent->nm_menu,
            'child_menu_active'   => $this->menu->nm_menu,
            // 't_riwayat_kesehatan_det' => $t_riwayat_kesehatan_det,
            't_riwayat_kesehatan' => $t_riwayat_kesehatan,
        ];

        return view('admin.report.r_form_rk.view_info')->with($data);
    }

    public function dt_info(Request $request)
    {
        // dd($request->id_t_sds);
        $table = T_riwayat_kesehatan::orderBy('id_t_riwayat_kesehatan')
        ->with('m_lokasi_pemeriksaan')
        ->where('id_t_riwayat_kesehatan', $request->id_t_riwayat_kesehatan)
            ->get();
        // dd($table);
        $datas = [];
        $i = 1;
        foreach ($table as $key => $value) {
            // dump($value->tanggal_t_riwayat_kesehatan);
            // $datas[$key][] = $i++;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d', $value->tanggal_periksa_t_riwayat_kesehatan)->format('d-m-Y');
            // $datas[$key][] = $value->tanggal_t_riwayat_kesehatan;
            $datas[$key][] = $value->email_t_riwayat_kesehatan;
            $datas[$key][] = $value->m_lokasi_pemeriksaan->nm_m_lokasi_pemeriksaan;
            $datas[$key][] = $value->nik_t_riwayat_kesehatan;
            $datas[$key][] = $value->umur_t_riwayat_kesehatan;
            $datas[$key][] = (
                $value->jk_t_riwayat_kesehatan==0?'MALE':'FEMALE'
            );
            $datas[$key][] = $value->jabatan_t_riwayat_kesehatan;
            $datas[$key][] = $value->divisi_t_riwayat_kesehatan;
            $datas[$key][] = $value->lokasi_t_riwayat_kesehatan;
            $datas[$key][] = $value->tanggal_periksa_t_riwayat_kesehatan;
            $datas[$key][] = $value->dokter_pemeriksa_t_riwayat_kesehatan;
            // $datas[$key][] = '<div class="btn-group">
            //                         <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
            //                         actions
            //                         </button>
            //                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto  auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
            //                             <a class="dropdown-item view_info" data-id_t_sds="' . $value->id_t_sds . '" href="#">Submittee Info</a>
            //                             <a class="dropdown-item view_ans" data-id_t_sds="' . $value->id_t_sds . '" href="#">SDS Response</a>
            //                         </div>
            //                     </div>';
        }

        $data = [
            'data' => $datas
        ];

        return response()->json($data);
    }

    public function download_xls()
    {
        return Excel::download(new T_riwayat_kesehatan_export, 'export_form_riwayat_kesehatan.xlsx');
    }
}
