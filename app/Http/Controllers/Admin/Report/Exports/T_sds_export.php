<?php

namespace App\Http\Controllers\Admin\Report\Exports;

use DB;
use App\Models\M_faq;
use App\Models\M_kabko;
use App\Models\T_permohonan_vitamin;
use App\Http\Controllers\Controller;
use App\Models\M_hak_akses;
use App\Models\M_sds;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use App\Models\T_sds;
use App\Models\T_sds_det;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class T_sds_export implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view(
            'admin.exports.t_sds_export',
            [
                'm_sds'=>M_sds::orderBy('id_m_sds')->get(),
                't_sds'=>T_sds::orderBy('id_t_sds')
                //->with('m_lokasi_pemeriksaan')
                ->get(),
                't_sds_det'=>T_sds_det::with('m_sds')->orderBy('id_t_sds_det')
                ->get()
            ]
        );
    }
}
