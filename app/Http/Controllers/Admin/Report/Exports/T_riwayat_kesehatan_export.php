<?php

namespace App\Http\Controllers\Admin\Report\Exports;

use DB;
use App\Models\M_faq;
use App\Models\M_kabko;
use App\Models\T_permohonan_vitamin;
use App\Http\Controllers\Controller;
use App\Models\M_hak_akses;
use App\Models\M_kebiasaan_hidup;
use App\Models\M_keluhan;
use App\Models\M_konsumsi_obat;
use App\Models\M_penyakit_keluarga;
use App\Models\M_riwayat_penyakit;
use App\Models\M_sds;
use App\Models\T_riwayat_kesehatan;
use App\Models\T_riwayat_kesehatan_det;
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

class T_riwayat_kesehatan_export implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view(
            'admin.exports.t_riwayat_kesehatan_export',
            [
                'm_keluhan'=>M_keluhan::orderBy('id_m_keluhan')->get(),
                'm_riwayat_penyakit'=>M_riwayat_penyakit::orderBy('id_m_riwayat_penyakit')->get(),
                'm_penyakit_keluarga' => M_penyakit_keluarga::orderBy('id_m_penyakit_keluarga')->get(),
                'm_konsumsi_obat' => M_konsumsi_obat::orderBy('id_m_konsumsi_obat')->get(),
                'm_kebiasaan_hidup' => M_kebiasaan_hidup::orderBy('id_m_kebiasaan_hidup')->get(),
                't_riwayat_kesehatan'=>T_riwayat_kesehatan::orderBy('id_t_riwayat_kesehatan')
                // ->with('m_lokasi_pemeriksaan')
                ->get(),
                't_riwayat_kesehatan_det'=>T_riwayat_kesehatan_det::
                // with('m_keluhan', 'm_konsumsi_obat', 'm_riwayat_penyakit', 'm_penyakit_keluarga', 'm_kebiasaan_hidup')
                with('t_riwayat_kesehatan')
                ->orderBy('id_t_riwayat_kesehatan_det')
                ->get()
            ]
        );
    }
}
