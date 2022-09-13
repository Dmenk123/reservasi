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
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\T_jadwal_rutin;
use App\Models\T_pembayaran;
use App\Models\T_pembayaran_det;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Datatables\Datatables;

class Lap_pendapatan extends Controller
{

    public function show_report()
    {
        $data = [
            'head_title' => 'Pendapatan',
            'page_title' => 'Pendapatan',
            'parent_menu_active' => 'Laporan',
            'child_menu_active'   => 'Pendapatan',
        ];

        if(request()->filled('bulan') && request()->filled('tahun')) {
            $tgl_awal = Carbon::createFromFormat('Y-m-d', request()->get('tahun').'-'.request()->get('bulan').'-01')->format('Y-m-d');
            $tgl_akhir = Carbon::parse($tgl_awal)->endOfMonth()->format('Y-m-d');
            $data_report = T_pembayaran_det::with(['t_pembayaran.t_reservasi'])->whereBetween('tgl_t_pembayaran_det', [$tgl_awal, $tgl_akhir])->orderByDesc('tgl_t_pembayaran_det')->get();

            // dd($data_report);

            $html_report = view('admin.lap_pendapatan.print_pdf', [
                'datanya' => $data_report,
                'tgl_awal' => $tgl_awal,
                'tgl_akhir' => $tgl_akhir,
                'bulan' => request()->get('bulan'),
                'tahun' => request()->get('tahun'),
            ])->render();

            $data += [
                'html_report' => $html_report
            ];
        }

        return view('admin.lap_pendapatan.index')->with($data);
    }

    public function iframe_lap_pendapatan()
    {
        if(request()->filled('tahun') && request()->filled('bulan')) {
            return view('admin.lap_pendapatan.iframe');
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Failed to show report !!!'
            ]);
        }

    }

    public function pdf_lap_pendapatan()
    {

        $tgl_awal = Carbon::createFromFormat('Y-m-d', request()->get('tahun').'-'.request()->get('bulan').'-01')->format('Y-m-d');
        $tgl_akhir = Carbon::parse($tgl_awal)->endOfMonth()->format('Y-m-d');
        $data_report = T_pembayaran_det::with(['t_pembayaran.t_reservasi'])->whereBetween('tgl_t_pembayaran_det', [$tgl_awal, $tgl_akhir])->orderByDesc('tgl_t_pembayaran_det')->get();

        $pdf = \PDF::loadView('admin.lap_pendapatan.print_pdf', [
            'datanya' => $data_report,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'bulan' => request()->get('bulan'),
            'tahun' => request()->get('tahun'),
        ]);


        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream("Laporan-pendapatan-".request()->get('tahun').'-'.request()->get('bulan').'-'.time().".pdf", array("Attachment" => false));
    }


}
