<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use App\Models\M_app;
use App\Models\M_menu;
use App\Models\T_jadwal_rutin;
use App\Models\T_reservasi;
use App\Models\T_reservasi_det;
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
use App\Http\Controllers\MailController;

class BookingController extends Controller
{

    public function jadwal(Request $request)
    {
        $calendar = array();
        $type = $request->type;

		// Menentukan Tanggal 1 Bulan
		// $sebulan = mktime(0,0,0,date("n"),date("j")+14,date("Y"));
		// $semua   = date("d-m-Y", $sebulan);
		// $begin 	 = new DateTime(date('Y-m-d'));
		// $end 	 = new DateTime($semua);

		// $interval = DateInterval::createFromDateString('1 day');
		// $period = new DatePeriod($begin, $interval, $end);

        $start = Carbon::now()->format('Y-m-d');
        $end  = Carbon::now()->addMonths(2)->format('Y-m-d');
        $period = CarbonPeriod::create($start, '1 day', $end);

		$dayList = array(
			'Sun' => 'minggu',
			'Mon' => 'senin',
			'Tue' => 'selasa',
			'Wed' => 'rabu',
			'Thu' => 'kamis',
			'Fri' => 'jumat',
			'Sat' => 'sabtu'
		);

        foreach ($period as $val)
		{
            $hari = $dayList[$val->format("D")];
            $cek_jadwal= T_jadwal_rutin::where('hari', $hari)->where('status', 1)->first();
            if ($cek_jadwal) {
                $calendar[] = array(
                    'id' 	=> 52,
                    'title' => $val->format("d"),
                    'type' => $type,
                    'start' => $val->format('Y-m-d'),
                    'color' => '#18ab18',
                );
            }

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

        $dayList = array(
			'Sun' => 'minggu',
			'Mon' => 'senin',
			'Tue' => 'selasa',
			'Wed' => 'rabu',
			'Thu' => 'kamis',
			'Fri' => 'jumat',
			'Sat' => 'sabtu'
		);

        $day = date("D", $seconds);
        $hari = T_jadwal_rutin::where('hari', $dayList[$day])->where('status', 1)->first();

        $start = Carbon::parse($tanggal.' '.$hari->jam_mulai);
        $end = Carbon::parse($tanggal.' '.$hari->jam_akhir);

        $start_loop = Carbon::parse($tanggal.' '.$hari->jam_mulai);

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
                //lakukan interval 2 jam
                $start_loop =  Carbon::parse($start_loop)->addHour(2);
                //jika kelebihan maka ambil dari jam akhir
                if ($start_loop > $end) {
                    $start_loop = $end;
                }
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

    public function saveReservasi(Request $request)
    {

        $messages = [
            'nama.required' => 'Mohon isikan nama anda',
            'email.required' => 'Mohon isikan email anda',
            'telp.required' => 'Mohon isikan kontak telepon anda',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            // 'id_m_user_group' => ['required'],
            'email' => ['required'],
            'telp' => ['required'],

        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'nama' => $errors->first('nama'),
                    'email' => $errors->first('email'),
                    'telp' => $errors->first('telp')
                ]
            ]);
        }

        $dayList = array(
			'Sun' => 'minggu',
			'Mon' => 'senin',
			'Tue' => 'selasa',
			'Wed' => 'rabu',
			'Thu' => 'kamis',
			'Fri' => 'jumat',
			'Sat' => 'sabtu'
		);

        // $day = date("D", $request->date);
        $day = Carbon::parse($request->date)->format("D");

        $hari = $dayList[$day];

        DB::beginTransaction();
        $object = new T_reservasi;
        $object->id_t_reservasi = T_reservasi::MaxId();
        $object->nm_t_reservasi = $request->nama;
        $object->email_reservasi = $request->email;
        $object->telp_t_reservasi = $request->telp;
        $object->hari_t_reservasi = $hari;
        $object->id_m_proses = 1;
        $object->tanggal_t_reservasi = $request->date;
        $object->jam_t_reservasi = $request->time;
        $object->jenis_t_reservasi = ($request->type == 'lunas') ? 'cash' : 'angsuran';
        $object->metode_pembayaran_t_reservasi = ($request->type == 'lunas') ? 'upload' : 'gateway';
        $kode_verifikasi = $this->random();
        $object->kode_t_reservasi = $kode_verifikasi;
        $object->created_at = Carbon::now()->format('Y-m-d H:i:s');

        try{
            $object->save();
            // $email = new MailController;
            // ### send email
            // $send_email = $email->send_email_link_upload(trim($request->email), $object);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Tersimpan !',
                'kode_verifikasi' => $kode_verifikasi
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
                'kode_verifikasi' => null
            ]);
        }
    }

    public function formUploadPembayaran(Request $request)
    {
        $data = [
            'kode_verifikasi' => $request->code
        ];
        return view('web.fo.pages.upload-pembayaran')->with($data);
    }

    public function random()
    {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand =  substr(str_shuffle(str_repeat($pool, 5)), 0, 16);

        return $rand;
    }

    public function savePembayaran(Request $request)
    {
        $messages = [
            'bank.required' => 'Mohon isikan nama bank anda',
            'nominal.required' => 'Mohon isikan jumlah nominal transfer',
            'foto.required' => 'Mohon upload bukti pembayaran',
        ];

        $validator = Validator::make($request->all(), [
            'bank' => ['required'],
            // 'id_m_user_group' => ['required'],
            'nominal' => ['required'],
            'foto' => ['required'],

        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'bank' => $errors->first('bank'),
                    'nominal' => $errors->first('nominal'),
                    'foto' => $errors->first('foto')
                ]
            ]);
        }

        
       

        DB::beginTransaction();
        $object = T_reservasi::where('kode_t_reservasi', $request->kode_verifikasi)->first();
        $object->bank = $request->bank;
        $object->nominal_transfer = $request->nominal;
        $object->id_m_proses = 3;
        $object->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $image = $request->file('foto');
        if ($image) {
            $name = 'bukti_'.$request->kode_verifikasi;
            $fileName = $name . '.' . $image->getClientOriginalExtension();
 
            $folder = T_reservasi::UPLOAD_DIR;
 
            $filePath = $image->storeAs($folder . '/original', $fileName, 'public');
            $resizedImage = $this->_resizeImage($image, $fileName, $folder);
 
            // $params['original'] = $filePath;
            // $params['medium'] = $resizedImage['medium'];
            // $params['small'] = $resizedImage['small'];
 
            // unset($params['image']);
        }

        $det = new T_reservasi_det;
        $det->kode_t_reservasi =  $request->kode_verifikasi;
        $det->oiginal = $filePath;
        $det->medium = $resizedImage['medium'];
        $det->small = $resizedImage['small'];


        try{
            $object->save();
            $det->save();
          

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Tersimpan !',
                'kode_verifikasi' => $request->kode_verifikasi
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
                'kode_verifikasi' => null
            ]);
        }
    }

    private function _resizeImage($image, $fileName, $folder)
    {
        $resizedImage = [];
 
        $smallImageFilePath = $folder . '/small/' . $fileName;
        $size = explode('x', T_reservasi::SMALL);
        list($width, $height) = $size;
 
        $smallImageFile = Image::make($image)->fit($width, $height)->stream();
        if (Storage::put('public/' . $smallImageFilePath, $smallImageFile)) {
            $resizedImage['small'] = $smallImageFilePath;
        }
        
        $mediumImageFilePath = $folder . '/medium/' . $fileName;
        $size = explode('x', T_reservasi::MEDIUM);
        list($width, $height) = $size;
 
        $mediumImageFile = Image::make($image)->fit($width, $height)->stream();
        if (Storage::put('public/' . $mediumImageFilePath, $mediumImageFile)) {
            $resizedImage['medium'] = $mediumImageFilePath;
        }
 
        // $largeImageFilePath = $folder . '/large/' . $fileName;
        // $size = explode('x', Shop::LARGE);
        // list($width, $height) = $size;
 
        // $largeImageFile = Image::make($image)->fit($width, $height)->stream();
        // if (Storage::put('public/' . $largeImageFilePath, $largeImageFile)) {
        // 	$resizedImage['large'] = $largeImageFilePath;
        // }
 
        // $extraLargeImageFilePath  = $folder . '/xlarge/' . $fileName;
        // $size = explode('x', Shop::EXTRA_LARGE);
        // list($width, $height) = $size;
 
        // $extraLargeImageFile = Image::make($image)->fit($width, $height)->stream();
        // if (Storage::put('public/' . $extraLargeImageFilePath, $extraLargeImageFile)) {
        // 	$resizedImage['extra_large'] = $extraLargeImageFilePath;
        // }
 
        return $resizedImage;
    }


    ### coba
    public function jajalEmail()
    {
        $mailto = 'slebzt@gmail.com';
        $email = new MailController;
        $object = T_reservasi::first();
        ### send email
        try {
            $send_email = $email->send_email_link_upload(trim($mailto), $object);
            echo 'sukses';
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


}
