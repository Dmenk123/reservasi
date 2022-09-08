<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\T_mcus;

use App\Models\M_branch;
use App\Models\M_entity;
use App\Models\T_qrcode;
use Carbon\CarbonPeriod;
use App\Models\M_proses;
use App\Models\T_booking;
use App\Models\T_content;
use App\Models\M_employee;
use App\Models\M_hak_akses;
use App\Models\T_reservasi;
use Illuminate\Http\Request;
use App\Models\T_content_det;
use App\Models\T_jadwal_rutin;
use App\Models\T_reservasi_det;
use App\Models\M_harga;
use App\Models\T_emp_request_rct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\T_mcu;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MailController;
use App\Models\T_log_proses;
use Illuminate\Support\Facades\Validator;

use App\Veritrans\Midtrans;

class BookingController extends Controller
{
    public function __construct()
    {   
        Midtrans::$serverKey = 'SB-Mid-server-sZaLLb9rc5_mfPasoa9Hy96d';
        //set is production to true for production mode
        Midtrans::$isProduction = false;
    }

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
                    'tipe' => $type,
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

    // public function getJam(Request $request)
    // {
    //     $mil = $request->tanggal;
    //     $seconds = $mil / 1000;
    //     $tanggal = date("Y-m-d", $seconds);

    //     $dayList = array(
	// 		'Sun' => 'minggu',
	// 		'Mon' => 'senin',
	// 		'Tue' => 'selasa',
	// 		'Wed' => 'rabu',
	// 		'Thu' => 'kamis',
	// 		'Fri' => 'jumat',
	// 		'Sat' => 'sabtu'
	// 	);

    //     $day = date("D", $seconds);
    //     $hari = T_jadwal_rutin::with('m_interval')->where('hari', $dayList[$day])->where('status', 1)->first();

    //     $start = Carbon::parse($tanggal.' '.$hari->jam_mulai);
    //     $end = Carbon::parse($tanggal.' '.$hari->jam_akhir);

    //     $start_loop = Carbon::parse($tanggal.' '.$hari->jam_mulai);

    //     // $period = CarbonPeriod::create('2022-08-13 10:00:00', '2022-08-13 14:00:00');

    //     // Iterate over the period
    //     // foreach ($period as $date) {
    //     //     echo $date->format('Y-m-d H:i:s');
    //     // }

    //     $loop = 10;
    //     $interval = [];
    //     array_push($interval, $start );
    //     for ($i=0; $i < $loop; $i++) {
    //         if ($start_loop >= $start && $start_loop < $end ) {
    //             //lakukan interval 2 jam
    //             $start_loop =  Carbon::parse($start_loop)->addHour($hari->m_interval->durasi_m_interval);
    //             //jika kelebihan maka ambil dari jam akhir
    //             if ($start_loop > $end) {
    //                 $start_loop = $end;
    //             }
    //             array_push($interval, $start_loop );
    //         }
    //     }

    //     $res = null;
    //     foreach ($interval as $value) {
    //         $time = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i');
    //         $time_url = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');
    //         $date = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');

    //         $url = route('booking.konfirmasi-data-diri') .'?type='.$request->tipe.'&date='.$date.'&time='.$time_url;
    //         $res .= '<a href="'.$url.'" class="btn btn-sm btn-success-custom" style="margin-left:5px;margin-bottom:5px;width: 125px;font-size: 1.2rem!important;">' . $time . ' WIB';
    //     }

    //     echo $res;
    // }

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
            'email.email' => 'Mohon isikan alamat email valid',
            'telp.required' => 'Mohon isikan kontak telepon anda',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            // 'id_m_user_group' => ['required'],
            'email' => ['required', 'email'],
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
        $id_t_reservasi = T_reservasi::MaxId();

        ## get active harga
        $harga = M_harga::Active()->first();

        $object->id_t_reservasi = $id_t_reservasi;
        $object->nm_t_reservasi = $request->nama;
        $object->email_reservasi = $request->email;
        $object->telp_t_reservasi = $request->telp;
        $object->hari_t_reservasi = $hari;
        // $object->nominal_total = $harga->nominal_m_harga;
        $object->id_m_proses = M_proses::ID_M_PROSES_PENGISIAN_DATA_DIRI;
        $object->tanggal_t_reservasi = $request->date;
        $object->jam_t_reservasi = $request->time;
        $object->jenis_t_reservasi = ($request->type == 'lunas') ? 'cash' : 'kredit';
        $object->metode_pembayaran_t_reservasi = $request->pembayaran;
        $kode_verifikasi = $this->random();
        $object->kode_t_reservasi = $kode_verifikasi;
        $object->created_at = Carbon::now()->format('Y-m-d H:i:s');

        try{
            $object->save();

            $ins_log_proses = T_log_proses::create([
                'id_t_reservasi' => $id_t_reservasi,
                'id_m_proses' => M_proses::ID_M_PROSES_PENGISIAN_DATA_DIRI,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            $email = new MailController;
            ### send email
            $send_email = $email->send_email_link_upload(trim($request->email), $object);

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
        $reservasi = T_reservasi::where('kode_t_reservasi', $request->code)->first();
        if ($reservasi) {
            $data = [
                'kode_verifikasi' => $request->code,
                'reservasi'       => $reservasi
            ];
            return view('web.fo.pages.upload-pembayaran')->with($data);
        } else {
            return view('web.fo.pages.error-404');
        }


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
        $det->id_t_reservasi_det = T_reservasi_det::MaxId();
        $det->kode_t_reservasi =  $request->kode_verifikasi;
        $det->original = $filePath;
        $det->medium = $resizedImage['medium'];
        $det->small = $resizedImage['small'];
        $det->bank = $request->bank;
        $det->nominal = $request->nominal;
        $det->created_at = Carbon::now()->format('Y-m-d H:i:s');


        try{
            $object->save();
            $det->save();

            $ins_log_proses = T_log_proses::create([
                'id_t_reservasi' => $object->id_t_reservasi,
                'id_m_proses' => M_proses::ID_M_PROSES_PEMBAYARAN,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

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

    public function afterPayment($id)
    {
        $reservasi = T_reservasi::where('kode_t_reservasi', $id)->first();
        if ($reservasi) {
            $proses_selanjutnya = $reservasi->id_m_proses + 1;
            $status = M_proses::findOrFail($proses_selanjutnya);
            $keterangan_status = $status->id_m_proses == 4 ? 'Menunggu '.$status->nm_m_proses : $status->nm_m_proses;
            $data = [
                // 'kode_verifikasi' => $request->code,
                'reservasi'       => $reservasi,
                'keterangan_status' => $keterangan_status
            ];
            return view('web.fo.pages.after-payment')->with($data);
        } else {
            return view('web.fo.pages.error-404');
        }
    }


    #############################
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
        $hari = T_jadwal_rutin::with('t_jadwal_rutin_det')->where('hari', $dayList[$day])->where('status', 1)->first();
        $res = null;
        foreach ($hari->t_jadwal_rutin_det as $value) {
            $time = Carbon::createFromFormat('Y-m-d H:i:s', $tanggal.' '.$value->pukul)->format('H:i');
            $time_url = Carbon::createFromFormat('Y-m-d H:i:s', $tanggal.' '.$value->pukul)->format('H:i:s');
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $tanggal.' '.$value->pukul)->format('Y-m-d');

            $url = route('booking.konfirmasi-data-diri') .'?type='.$request->tipe.'&date='.$date.'&time='.$time_url;
            $is_booking = T_reservasi::where('tanggal_t_reservasi', $tanggal)->where('jam_t_reservasi', $value->pukul)->where('id_m_proses', 4)->whereNull('deleted_at')->first();
            if ($is_booking) {
                $res .= '<a href="" onclick="return false;" class="btn btn-sm btn-danger" style="margin-left:5px;margin-bottom:5px;width: 125px;font-size: 1.2rem!important;background-color: #cfcfcf;border-color: #cfcfcf;">'. $time . ' WIB';
            }else{
                $res .= '<a href="'.$url.'" class="btn btn-sm btn-success-custom" style="margin-left:5px;margin-bottom:5px;width: 125px;font-size: 1.2rem!important;">' . $time . ' WIB';
            }
           
           
        }

        echo $res;
    }

    public function token(Request $request) 
    {
        error_log('masuk ke snap token dri ajax');
        $midtrans = new Midtrans;

        $member = T_reservasi::where('kode_t_reservasi', $request->code)->first();

        $transaction_details = array(
            'order_id'      => uniqid(),
            'gross_amount'  => $request->price
        );

        // Populate items
        $items = [
            array(
                'id'        => 'item1',
                'price'     => $request->price,
                'quantity'  => 1,
                'name'      => 'Adidas f50'
            )
        ];

        // Populate customer's billing address
        $billing_address = array(
            'first_name'    => $member->nm_t_reservasi,
            'last_name'     => "",
            'address'       => "Karet Belakang 15A, Setiabudi.",
            'city'          => "Jakarta",
            'postal_code'   => "51161",
            'phone'         => $member->telp_t_reservasi,
            'country_code'  => 'IDN'
            );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'    => "John",
            'last_name'     => "Watson",
            'address'       => "Bakerstreet 221B.",
            'city'          => "Jakarta",
            'postal_code'   => "51162",
            'phone'         => "081322311801",
            'country_code'  => 'IDN'
            );

        // Populate customer's Info
        $customer_details = array(
            'first_name'      => $member->nm_t_reservasi,
            'last_name'       => "",
            'email'           => $member->email_reservasi,
            'phone'           => $member->telp_t_reservasi,
            'billing_address' => $billing_address,
            'shipping_address'=> $shipping_address
            );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit'       => 'hour', 
            'duration'   => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $items,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );
    
        try
        {
            $snap_token = $midtrans->getSnapToken($transaction_data);
            //return redirect($vtweb_url);
            echo $snap_token;
            // echo json_encode(['token'=>$snap_token, 'transData' => $transaction_data]);
        } 
        catch (Exception $e) 
        {   
            return $e->getMessage;
        }
    }

    public function finish(Request $request)
    {
        $result = $request->input('result_data');
        $kode_reservasi = $request->input('kode-reservasi');
        $result = json_decode($result);

        DB::beginTransaction();
        
        if (isset($result->va_number[0]->bank)) {
			$bank = $result->va_number[0]->bank;
		} else {
			$bank = '-';
		}

		if (isset($result->va_number[0]->va_number)) {
			$va_number = $result->va_number[0]->va_number;
		} else {
			$va_number = '-';
		}

		if (isset($result->bca_va_number)) {
			$bca_va_number = $result->bca_va_number;
		} else {
			$bca_va_number = '-';
		}

		if (isset($result->bill_key)) {
			$bill_key = $result->bill_key;
		} else {
			$bill_key = '-';
		}

		if (isset($result->biller_code)) {
			$biller_code = $result->biller_code;
		} else {
			$biller_code = '-';
		}

		if (isset($result->permata_va_number)) {
			$permata_va_number = $result->permata_va_number;
		} else {
			$permata_va_number = '-';
		}

        $reservasi_det = new T_reservasi_det;
        $reservasi_det->id_t_reservasi_det = T_reservasi_det::MaxId();
        $reservasi_det->kode_t_reservasi = $kode_reservasi;
        $reservasi_det->bank = $bank;
        $reservasi_det->status_code = $result->status_code;
        $reservasi_det->status_message = $result->status_message;
        $reservasi_det->transaction_id = $result->transaction_id;
        $reservasi_det->order_id = $result->order_id;
        $reservasi_det->nominal = $result->gross_amount;
        $reservasi_det->payment_type = $result->payment_type;
        $reservasi_det->transaction_time = $result->transaction_time;
        $reservasi_det->transaction_status = $result->transaction_status;
        $reservasi_det->va_number = $va_number;
        $reservasi_det->fraud_status = $result->fraud_status;
        $reservasi_det->bca_va_number = $bca_va_number;
        $reservasi_det->permata_va_number = $permata_va_number;
        $reservasi_det->pdf_url = $result->pdf_url;
        $reservasi_det->finish_redirect_url = $result->finish_redirect_url;
        $reservasi_det->bill_key = $bill_key;
        $reservasi_det->biller_code = $biller_code;
        $reservasi_det->created_at = Carbon::now()->format('Y-m-d H:i:s');

        try{
            $reservasi_det->save();

            DB::commit();
            return redirect(route('booking.after-payment', ['id' => $kode_t_reservasi]));
           
        }catch(\Exception $e){
            DB::rollback();
        }
        // echo $result->status_message . '<br>';
        // echo 'RESULT <br><pre>';
        // var_dump($result);
        // echo '</pre>' ;
    }

    public function notification()
    {
        $midtrans = new Midtrans;
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if($result){
        $notif = $midtrans->status($result->order_id);
        }

        error_log(print_r($result,TRUE));

        /*
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
          // For credit card transaction, we need to check whether transaction is challenge by FDS or not
          if ($type == 'credit_card'){
            if($fraud == 'challenge'){
              // TODO set payment status in merchant's database to 'Challenge by FDS'
              // TODO merchant should decide whether this transaction is authorized or not in MAP
              echo "Transaction order_id: " . $order_id ." is challenged by FDS";
              } 
              else {
              // TODO set payment status in merchant's database to 'Success'
              echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
              }
            }
          }
        else if ($transaction == 'settlement'){
          // TODO set payment status in merchant's database to 'Settlement'
          echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
          } 
          else if($transaction == 'pending'){
          // TODO set payment status in merchant's database to 'Pending'
          echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
          } 
          else if ($transaction == 'deny') {
          // TODO set payment status in merchant's database to 'Denied'
          echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }*/
   
    }
}
