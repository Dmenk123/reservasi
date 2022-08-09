<?php

namespace App\Http\Controllers\Admin\Report;

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
use App\Models\T_sds;
use App\Models\T_sds_det;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class Report_form_sds extends Controller
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

        return view('admin.report.r_form_sds.index')->with($data);
    }

    public function datatable(Request $request)
    {
        $table = T_sds::orderBy('id_t_sds')->get();
        // dd($table);
        $datas = [];
        $i = 1;
        foreach ($table as $key => $value) {
            // dump($value->tanggal_t_sds);
            $datas[$key][] = $i++;
            $datas[$key][] = $value->email_t_sds;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d', $value->tanggal_t_sds)->format('d-m-Y');
            $datas[$key][] = '<div class="btn-group">
                                    <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                    actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto  auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                        <a class="dropdown-item view_info" data-id_t_sds="' . $value->id_t_sds . '" href="#">Submittee Info</a>
                                        <a class="dropdown-item view_ans" data-id_t_sds="' . $value->id_t_sds . '" href="#">SDS Answer</a>
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
        $t_sds = T_sds::orderBy('id_t_sds')
            ->where('id_t_sds', $request->id_t_sds)
            ->first();

        $data = [
            'head_title' => $this->menu->nm_menu,
            'page_title' => 'SDS Answer',
            'parent_menu_active' => $this->parent->nm_menu,
            'child_menu_active'   => $this->menu->nm_menu,
            // 't_sds_det' => $t_sds_det,
            't_sds' => $t_sds,
        ];

        return view('admin.report.r_form_sds.view_ans')->with($data);
    }

    public function dt_ans(Request $request)
    {
        // dd($request->id_t_sds);
        $table = T_sds_det::orderBy('id_m_sds')
            ->with('m_sds')
            ->where('id_t_sds', $request->id_t_sds)
            ->get();
        // dd($table);
        $datas = [];
        $i = 1;
        foreach ($table as $key => $value) {
            // dump($value->tanggal_t_sds);
            $datas[$key][] = $i++;
            $datas[$key][] = $value->m_sds->nm_m_sds;
            $datas[$key][] = $value->ans_t_sds_det;
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
        $t_sds = T_sds::orderBy('id_t_sds')
        ->where('id_t_sds', $request->id_t_sds)
            ->first();

        $data = [
            'head_title' => $this->menu->nm_menu,
            'page_title' => 'SDS Answer',
            'parent_menu_active' => $this->parent->nm_menu,
            'child_menu_active'   => $this->menu->nm_menu,
            // 't_sds_det' => $t_sds_det,
            't_sds' => $t_sds,
        ];

        return view('admin.report.r_form_sds.view_info')->with($data);
    }

    public function dt_info(Request $request)
    {
        // dd($request->id_t_sds);
        $table = T_sds::orderBy('id_t_sds')
        // ->with('m_sds')
        ->where('id_t_sds', $request->id_t_sds)
            ->get();
        // dd($table);
        $datas = [];
        $i = 1;
        foreach ($table as $key => $value) {
            // dump($value->tanggal_t_sds);
            // $datas[$key][] = $i++;
            $datas[$key][] = \Carbon\Carbon::createFromFormat('Y-m-d', $value->tanggal_t_sds)->format('d-m-Y');
            // $datas[$key][] = $value->tanggal_t_sds;
            $datas[$key][] = $value->usia_t_sds;
            $datas[$key][] = $value->masa_kerja_t_sds;
            $datas[$key][] = $value->pendidikan_t_sds;
            $datas[$key][] = $value->wilayah_kerja_t_sds;
            $datas[$key][] = $value->jabatan_t_sds;
            $datas[$key][] = $value->status_pekerjaan_t_sds;
            $datas[$key][] = (
                $value->status_pernikahan_t_sds==0?'SINGLE':
                (
                    $value->status_pernikahan_t_sds==1?'MENIKAH':
                        (
                            $value->status_pernikahan_t_sds==2?'DUDA':
                                'JANDA'
                        )
                )
            );
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
        return Excel::download(new T_sds_export, 'export_form_sds.xlsx');
    }
}
