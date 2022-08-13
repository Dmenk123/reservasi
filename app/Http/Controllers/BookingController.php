<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\T_mcus;
use App\Models\M_branch;
use App\Models\M_entity;
use App\Models\T_qrcode;
use App\Models\M_user_fo;
use App\Models\T_booking;
use App\Models\T_content;
use App\Models\M_employee;
use App\Models\M_hak_akses;
use Illuminate\Http\Request;
use App\Models\T_content_det;
use App\Models\M_branch_company;
use App\Models\T_emp_request_rct;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\T_mcu;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{

    public function jadwal()
    {
        $calendar = array();

		// Menentukan Tanggal 1 Bulan
		$sebulan = mktime(0,0,0,date("n"),date("j")+14,date("Y"));
		$semua   = date("d-m-Y", $sebulan);
		$begin 	 = new DateTime(date('Y-m-d'));
		$end 	 = new DateTime($semua);

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);

		$dayList = array(
			'Sun' => 'minggu',
			'Mon' => 'senin',
			'Tue' => 'selasa',
			'Wed' => 'rabu',
			'Thu' => 'kamis',
			'Fri' => 'jumat',
			'Sat' => 'sabtu'
		);

        $calendar[] = array(
            'id' 	=> 1,
            'title' => $val->format("d"),
            'rutin' => intval(2),
            'start' => $val->format('Y-m-d'),
            'color' => '#00e12a',
        );
        $data = array();
        $data = [
            'get_data'=> json_encode($calendar),
		];

        return view('web.fo.pages.jadwal')->with($data);
    }


}