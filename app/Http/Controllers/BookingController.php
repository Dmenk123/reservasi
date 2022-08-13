<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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

    public function jadwal(Request $request)
    {
        $calendar = array();

		// Menentukan Tanggal 1 Bulan
		// $sebulan = mktime(0,0,0,date("n"),date("j")+14,date("Y"));
		// $semua   = date("d-m-Y", $sebulan);
		// $begin 	 = new DateTime(date('Y-m-d'));
		// $end 	 = new DateTime($semua);

		// $interval = DateInterval::createFromDateString('1 day');
		// $period = new DatePeriod($begin, $interval, $end);

		// $dayList = array(
		// 	'Sun' => 'minggu',
		// 	'Mon' => 'senin',
		// 	'Tue' => 'selasa',
		// 	'Wed' => 'rabu',
		// 	'Thu' => 'kamis',
		// 	'Fri' => 'jumat',
		// 	'Sat' => 'sabtu'
		// );

        $period = ['mobil'];

        foreach ($period as $val) 
		{

            $calendar[] = array(
                'id' 	=> 52,
                'title' => 12,
                'rutin' => 2,
                'start' => "2022-08-12",
                'color' => '#00e12a',
            );
        }
        $data = array();
        $data = [
            'get_data'=> json_encode($calendar),
		];

        return view('web.fo.pages.jadwal')->with($data);
    }

    public function getJam(Request $request)
    {
        $mil = $request->tanggal;
        $seconds = $mil / 1000;
        $tanggal = date("Y-m-d", $seconds);

        $start = Carbon::parse($tanggal.' 10:00:00');
        $end = Carbon::parse($tanggal.' 16:00:00');

        $start_loop = Carbon::parse($tanggal.' 10:00:00');

        // $period = CarbonPeriod::create('2022-08-13 10:00:00', '2022-08-13 14:00:00');

        // Iterate over the period
        // foreach ($period as $date) {
        //     echo $date->format('Y-m-d H:i:s');
        // }
        $loop = 10;
        $interval = [];
        array_push($interval, $start );
        for ($i=0; $i < $loop; $i++) { 
            if ($start_loop >= $start && $start_loop < $end ) {
                $start_loop =  Carbon::parse($start_loop)->addHour(2);
                array_push($interval, $start_loop );
            }
        }

        $res = null;
        foreach ($interval as $value) {
            $time = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i');
            $time_url = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');

            $url = route('booking.konfirmasi-data-diri') .'?type=lunas&date='.$date.'&time='.$time_url;
            $res .= '<a href="'.$url.'" class="btn btn-sm btn-success-custom" style="margin-left:5px;margin-bottom:5px;width: 125px;font-size: 1.2rem!important;">' . $time . ' WIB';
        }


        // Convert the period to an array of dates
        // $dates = $period->toArray();
        // dd($date);
        echo $res;
    }

    public function konfirmasiDataDiri(Request $request)
    {
        $type = $request->type;
        $date = $request->date;
        $time = $request->time;

        $data = [
            'type' => $type,
            'date' => $date,
            'time' => $time
        ];

        return view('web.fo.pages.data-diri')->with($data);
    }


}