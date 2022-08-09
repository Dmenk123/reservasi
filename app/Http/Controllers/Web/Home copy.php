<?php

namespace App\Http\Controllers\Web;

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

class Home extends Controller
{

    public function homepage()
    {
        $app = M_app::where(['id_m_app' => request()->get('id_app')])->IsActive()->firstOrFail();
        $data = [
            'id_m_app' => request()->get('id_app'),
            'id_m_user_group' => request()->get('id_user_group'),
            'token' => request()->get('token'),
            'app' => $app
        ];


        return view('web.fo.default')->with($data);
    }


    public function content(Request $request)
    {
        // dd($request->all());
        $id_user_group = $request->id_user_group;
        $app = M_app::where(['id_m_app' => $request->id_app])->IsActive()->firstOrFail();
        // get menu
        $menu = M_menu::where(['slug_m_menu' => $request->slug, 'id_m_app' => $request->id_app])->firstOrFail();

        $content = T_content::with(['m_app', 'm_menu', 't_content_det', 'm_user_group' => function($q) use ($id_user_group){
            $q->where('t_group_content.id_m_user_group', $id_user_group);
        }])->where([
            'id_m_menu' => $menu->id_m_menu,
            'id_m_app' => $request->id_app,
        ])->first();

        // dd($content, $request->all());

        // if($content == null ) {
        if($content == null || $content->m_user_group->isEmpty()) {
            return view('web.fo.default')->with([
                'id_m_app' => $request->id_app,
                'id_m_user_group' => $request->id_user_group,
                'token' => $request->token,
                'app' => $app
            ]);
        }

        $content_det = T_content_det::with(['m_component'])->where('id_t_content',  $content->id_t_content)->orderBy('sort_t_content_det')->get();

        $data = [
            'id_m_app' => $request->id_app,
            'id_m_user_group' => $request->id_user_group,
            'token' => $request->token,
            'content' => $content,
            'content_det' => $content_det,
            'app' => $app
        ];

        // dd($data);

        return view('web.fo.content')->with($data);
    }


    public function search_docs(Request $request)
    {
        // dd($request->all());

        abort_if(!request()->filled('token'), 404);
        $search = strtolower(trim($request->search));
        $id_app = $request->id_app;

        $id_user_group = $request->id_user_group;
        $app = M_app::where(['id_m_app' => $request->id_app])->IsActive()->firstOrFail();



        $menu_by_akses = \App\Models\M_hak_akses::whereHas('menu', function(\Illuminate\Database\Eloquent\Builder $query) use ($search, $id_app){
            $query->where('nm_menu', 'LIKE', '%'.$search.'%');
            $query->where('id_m_app', $id_app);
        })->where('id_m_user_group', $id_user_group)
        ->join('m_menu', 'm_menu.id_m_menu','=','m_hak_akses.id_m_menu')
        ->orderBy('m_menu.order_m_menu')
        ->groupBy('m_menu.id_m_menu')
        ->get();


        $data = [
            'id_m_app' => request()->get('id_app'),
            'id_m_user_group' => request()->get('id_user_group'),
            'token' => request()->get('token'),
            'app' => $app,
            'menu_by_akses' => $menu_by_akses
        ];


        return view('web.fo.search_result')->with($data);
    }

    public function show_pdf(Request $request)
    {
        // dd($request->all());
        $id_user_group = $request->id_user_group;
        $app = M_app::where(['id_m_app' => $request->id_app])->IsActive()->firstOrFail();
        $menu = M_menu::where(['slug_m_menu' => $request->slug, 'id_m_app' => $request->id_app])->firstOrFail();

        $content = T_content::with(['m_app', 'm_menu', 't_content_det', 'm_user_group' => function($q) use ($id_user_group){
            $q->where('t_group_content.id_m_user_group', $id_user_group);
        }])->where([
            'id_m_menu' => $menu->id_m_menu,
            'id_m_app' => $request->id_app,
        ])->first();

        $content_det = T_content_det::with(['m_component'])->where('id_t_content',  $content->id_t_content)->orderBy('sort_t_content_det')->get();

        $kampret = [
            'id_m_app' => $request->id_app,
            'id_m_user_group' => $id_user_group,
            'token' => $request->token,
            'content' => $content,
            'content_det' => $content_det,
            'app' => $app
        ];

        // return view('web.fo.content_pdf')->with($kampret);
        $pdf = PDF::loadView('web.fo.content_pdf', $kampret);

        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream("$app->nm_m_app - $menu->nm_menu user_guide" . time() . ".pdf", array("Attachment" => false));
    }

    // public function authenticate(Request $request)
    // {
    // 	$messages = [
    //         'nip_m_employee.required' => '* NIP is required',
    //     ];

    //     $validator = Validator::make($request->all(), [
    //         'nip_m_employee' => ['required'],
    //     ], $messages);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return response()->json([
    //             'error' => [
    //                 'nip_m_employee' => $errors->first('nip_m_employee'),
    //             ]
    //         ]);
    //     }

    //   //  \DB::enablequerylog();
    //     /**
    //      * search by NIP
    //      */
	// 	$cek = M_employee::where('nip_m_employee', $request->nip_m_employee)->orderby('id_m_employee','DESC')->first();

	// 	if($cek){


    //          //Start Pengecekan untuk tipe walkin harus melalui proses booking terlebih dahulu

    //     if ($request->tipe_t_qrcode=='walkin'){


    //         $cek_booking=T_booking::with('m_branch')->where('nip_m_employee', $request->nip_m_employee)->wherenull('status_booking')->first();

    //         if($cek_booking == null)
    //             {


    //                 return response()->json([
    //                     'status'  => false,
    //                     'message'  => 'Maaf, Anda belum melakukan booking, Untuk dapat checkin pada cabang pramita anda diwajibkan untuk booking online melalui laman berikut ini:<br> <b><a href="http://mcubooking.pramita.co.id">http://mcubooking.pramita.co.id</a></b> <br>selama quota masih tersedia',
    //                 ]);
    //             }

    //             if($cek_booking){ //sBegin Off  if($cek_booking){ Jika Bookingan ada di cek kembali apakah bookingan expired?

    //             $expired_date=Carbon::createFromFormat('Y-m-d', $cek_booking->date_t_booking)->format('Y-m-d');
    //             $expired_date_tampil=Carbon::createFromFormat('Y-m-d', $cek_booking->date_t_booking)->isoFormat('D MMMM YYYY');
    //             $now=date('Y-m-d');
    //             $cek_lokasi=T_qrcode::where('id_t_qrcode',$request->id_t_qrcode_cek)->first();

    //             if ( $now > $expired_date){

    //                 return response()->json([
    //                     'status'  => false,
    //                     'message'  => 'Maaf, Booking anda pada <br> Tanggal: <b>'. $expired_date_tampil.'</b> <br> Lokasi:<b> '.$cek_booking->m_branch->nm_m_branch.'</b><br <b><h4><span class="text-danger">Expired</span></h4></b> <br> Silahkan Melakukan booking ulang melalui laman berikut ini:<br> <b><a href="http://mcubooking.pramita.co.id">http://mcubooking.pramita.co.id</a></b> <br>selama quota masih tersedia',
    //                 ]);
    //             }


    //             if ( $expired_date > $now){

    //                 return response()->json([
    //                     'status'  => false,
    //                     'message'  => 'Maaf, Anda melakukan booking pada <br> Tanggal: <b>'. $expired_date_tampil.'</b> <br> Lokasi:<b> '.$cek_booking->m_branch->nm_m_branch.'</b><br <b><h4><span class="text-danger">Tanggal hari ini tidak sesuai dengan jadwal booking anda</span></h4></b> <br> Jika anda ingin memajukan jadwal pemeriksaan, Silahkan Melakukan booking ulang melalui laman berikut ini:<br> <b><a href="http://mcubooking.pramita.co.id">http://mcubooking.pramita.co.id</a></b> <br>selama quota masih tersedia',
    //                 ]);
    //             }



    //             if ( $cek_lokasi->id_m_branch != $cek_booking->id_m_branch){

    //                 return response()->json([
    //                     'status'  => false,
    //                     'message'  => 'Maaf, Booking anda pada <br> Tanggal: <b>'. $expired_date_tampil.'</b> <br> Lokasi:<b> '.$cek_booking->m_branch->nm_m_branch.'</b><br <b><h4><span class="text-danger">Tidak sesuai dengan lokasi checkin saat ini</span></h4></b> <br> Silahkan Melakukan booking ulang melalui laman berikut ini:<br> <b><a href="http://mcubooking.pramita.co.id">http://mcubooking.pramita.co.id</a></b> <br>selama quota masih tersedia <br> Atau mengunjungi lokasi checkin sesuai dengan data booking anda',
    //                 ]);
    //             }

    //         } // end off  if($cek_booking){


    //     }

    //      //End Off Pengecekan untuk tipe walkin harus melalui proses booking terlebih dahulu


    //     //  $cek_mcu=T_mcus::where('nip_m_employee', $request->nip_m_employee)->wherenull('time_out')->first();
    //     $cek_mcu=T_mcus::where('id_m_employee', $cek->id_m_employee)->wherenull('time_out')->first();

    //     //  $cek_mcu_lengkap=T_mcus::where('nip_m_employee', $request->nip_m_employee)->where('keterangan','LENGKAP')->first();
    //     $cek_mcu_lengkap=T_mcus::where('id_m_employee', $cek->id_m_employee)->where('keterangan','LENGKAP')->first();



    //      //dd( $cek_mcu);
    //      if($cek_mcu)
    //          {
    //              $lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu->id_t_qrcode)->first();

    //              $cari_lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu->id_t_qrcode)->first();
    //              //$date_mcu=Carbon::createFromFormat('Y-m-d', $cek_mcu->time_in)->isoFormat('D MMMM YYYY');
    //              $date_mcu=$cek_mcu->time_in;



    //              if ($cari_lokasi_before->id_m_branch){

    //                  $lokasi_before_query=M_branch::where('id_m_branch',$cari_lokasi_before->id_m_branch)->first();
    //                  $lokasi_before=$lokasi_before_query->nm_m_branch;
    //              }else if ($cari_lokasi_before->id_m_branch_company){

    //                  $lokasi_before_query=M_branch_company::with('m_company')->where('id_m_branch_company',$cari_lokasi_before->id_m_branch_company)->first();
    //                  $lokasi_before=$lokasi_before_query->nm_m_branch_company."-".$lokasi_before_query->m_company->nm_m_company;
    //              } else {


    //                  $lokasi_before='';
    //              }


    //              return response()->json([
    //                  'status'  => false,
    //                  'message'  => 'Maaf, Anda sebelumnya telah melakukan checkin dan belum melakukan checkout pada <br> <b>lokasi: '.$lokasi_before.'</b><br><b>Tanggal: '.$date_mcu.'</b><br>Mohon untuk melakukan checkout terlebih dahulu untuk melanjutkan proses checkin',
    //              ]);
    //          }




    //          if($cek_mcu_lengkap)
    //          {
    //              $lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu_lengkap->id_t_qrcode)->first();

    //              $cari_lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu_lengkap->id_t_qrcode)->first();
    //              //$date_mcu=Carbon::createFromFormat('Y-m-d', $cek_mcu_lengkap->time_in)->isoFormat('D MMMM YYYY');
    //              $date_mcu=$cek_mcu_lengkap->time_in;



    //              if ($cari_lokasi_before->id_m_branch){

    //                  $lokasi_before_query=M_branch::where('id_m_branch',$cari_lokasi_before->id_m_branch)->first();
    //                  $lokasi_before=$lokasi_before_query->nm_m_branch;
    //              }else if ($cari_lokasi_before->id_m_branch_company){

    //                  $lokasi_before_query=M_branch_company::with('m_company')->where('id_m_branch_company',$cari_lokasi_before->id_m_branch_company)->first();
    //                  $lokasi_before=$lokasi_before_query->nm_m_branch_company."-".$lokasi_before_query->m_company->nm_m_company;
    //              } else {


    //                  $lokasi_before='';
    //              }


    //              return response()->json([
    //                  'status'  => false,
    //                  'message'  => 'Maaf, anda tidak bisa melakukan booking karena seluruh proses medical Checkup anda telah selesai pada <br> <b>Lokasi: '.$lokasi_before.'</b><br><b>Tanggal: '.$date_mcu.'</b><br>Terimakasih',
    //              ]);
    //          }

    //          //PENGECEKAN JIKA MELAKUKAN CHECKOIN DITEMPAT YANG SAMA KETIKA BELUM LENGKAP MAKA NO REG AKAN DITAMPILKAN
    //         //  $cek_no_reg=T_mcus::where('nip_m_employee', $request->nip_m_employee)->where('keterangan','BELUM LENGKAP')->wherenull('keterangan_2')->first();

    //         $cek_no_reg=T_mcus::where('id_m_employee', $cek->id_m_employee)->where('keterangan','BELUM LENGKAP')->wherenull('keterangan_2')->first();




    //          if ($cek_no_reg){

    //             $lokasi_sekarang=T_qrcode::where('id_t_qrcode', $request->id_t_qrcode_cek)->first();
    //             $lokasi_no_reg_before=T_qrcode::where('id_t_qrcode',$cek_no_reg->id_t_qrcode)->first();

    //             // if ($lokasi_sekarang->id_m_branch==$lokasi_no_reg_before->id_m_branch){

    //             //     $no_kemarin=$cek_no_reg->no_reg;


    //             // }else {

    //             //     $no_kemarin='';
    //             // }

    //             $no_kemarin=$cek_no_reg->no_reg;



    //             }else {

    //                 $no_kemarin='';
    //             }


    //         return response()->json([
    //             'status'  => true,
    //             'data' => [
    //                 0 => $cek->nip_m_employee,
    //                 1 => $cek->nm_m_employee,
    //                 // 2 => $cek->dob_m_employee ? \Carbon\Carbon::createFromFormat('Y-m-d',$cek->dob_m_employee)->isoFormat('D MMMM YYYY') : null,
    //                 2 => $cek->dob_m_employee ? \Carbon\Carbon::createFromFormat('Y-m-d',$cek->dob_m_employee)->format('d-m-Y') : null,

    //                 3 => $cek->address_m_employee,
    //                 4 => $cek->id_m_employee,
    //                 5 => $cek->hp_m_employee,
    //                 6 => $cek->email_m_employee,
    //                 7 => $no_kemarin
    //             ],
    //         ]);
	// 	}else{
    //         /**
    //          * search by NIPK
    //          */
    //         $cek2 = M_employee::where('nipk_m_employee', $request->nip_m_employee)->orderby('id_m_employee','DESC')->first();
    //         if($cek2){
    //             return response()->json([
    //                 'status'  => true,
    //                 'data' => [
    //                     0 => $cek2->nip_m_employee,
    //                     1 => $cek2->nm_m_employee,
    //                     2 => $cek2->dob_m_employee ? \Carbon\Carbon::createFromFormat('Y-m-d',$cek2->dob_m_employee)->isoFormat('D MMMM YYYY') : null,
    //                     3 => $cek2->address_m_employee,
    //                 ],
    //             ]);
    //         }

    //         /**
    //          * DATA EMPLOYEE NOT FOUND
    //          */

    //         return response()->json([
    //             'status'  => false,
    //             'message'  => 'Invalid NIP !',
    //         ]);
    //     }


    // }


    // public function authenticate_booking(Request $request)
    // {
    // 	$messages = [
    //         'nip_m_employee.required' => '* NIP is required',
    //     ];

    //     $validator = Validator::make($request->all(), [
    //         'nip_m_employee' => ['required'],
    //     ], $messages);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return response()->json([
    //             'error' => [
    //                 'nip_m_employee' => $errors->first('nip_m_employee'),
    //             ]
    //         ]);
    //     }

    //   //  \DB::enablequerylog();
    //     /**
    //      * search by NIP
    //      */
	// 	// $cek = M_employee::where('nip_m_employee', $request->nip_m_employee)->first();
    //     $cek = M_employee::where('nip_m_employee', $request->nip_m_employee)->orderby('id_m_employee','DESC')->first();

	// 	if($cek){

    //        //Asli sebelum di ubah
    //         // $cek_mcu=T_mcus::where('nip_m_employee', $request->nip_m_employee)->wherenull('time_out')->first();

    //         //PEngecekan baru berdasarkan id_m_employee
    //         $cek_mcu=T_mcus::where('id_m_employee', $cek->id_m_employee)->wherenull('time_out')->first();
    //         //\DB::enablequerylog();
    //         $cek_mcu_lengkap=T_mcus::where('id_m_employee', $cek->id_m_employee)->where('keterangan','LENGKAP')->first();
    //         //dd(\DB::getquerylog());


    //         //dd( $cek_mcu);
    //         if($cek_mcu)
    //             {
    //                 $lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu->id_t_qrcode)->first();

    //                 $cari_lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu->id_t_qrcode)->first();
    //                 //$date_mcu=Carbon::createFromFormat('Y-m-d', $cek_mcu->time_in)->isoFormat('D MMMM YYYY');
    //                 $date_mcu=$cek_mcu->time_in;



    //                 if ($cari_lokasi_before->id_m_branch){

    //                     $lokasi_before_query=M_branch::where('id_m_branch',$cari_lokasi_before->id_m_branch)->first();
    //                     $lokasi_before=$lokasi_before_query->nm_m_branch;
    //                 }else if ($cari_lokasi_before->id_m_branch_company){

    //                     $lokasi_before_query=M_branch_company::with('m_company')->where('id_m_branch_company',$cari_lokasi_before->id_m_branch_company)->first();
    //                     $lokasi_before=$lokasi_before_query->nm_m_branch_company."-".$lokasi_before_query->m_company->nm_m_company;
    //                 } else {


    //                     $lokasi_before='';
    //                 }


    //                 return response()->json([
    //                     'status'  => false,
    //                     'message'  => 'Maaf, Anda sebelumnya telah melakukan checkin dan belum melakukan checkout pada <br> <b>lokasi: '.$lokasi_before.'</b><br><b>Tanggal: '.$date_mcu.'</b><br>Mohon untuk melakukan checkout terlebih dahulu untuk melanjutkan proses booking',
    //                 ]);
    //             }




    //             if($cek_mcu_lengkap)
    //             {
    //                 $lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu_lengkap->id_t_qrcode)->first();

    //                 $cari_lokasi_before=T_qrcode::with('m_branch')->where('id_t_qrcode',$cek_mcu_lengkap->id_t_qrcode)->first();
    //                 //$date_mcu=Carbon::createFromFormat('Y-m-d', $cek_mcu_lengkap->time_in)->isoFormat('D MMMM YYYY');
    //                 $date_mcu=$cek_mcu_lengkap->time_in;



    //                 if ($cari_lokasi_before->id_m_branch){

    //                     $lokasi_before_query=M_branch::where('id_m_branch',$cari_lokasi_before->id_m_branch)->first();
    //                     $lokasi_before=$lokasi_before_query->nm_m_branch;
    //                 }else if ($cari_lokasi_before->id_m_branch_company){

    //                     $lokasi_before_query=M_branch_company::with('m_company')->where('id_m_branch_company',$cari_lokasi_before->id_m_branch_company)->first();
    //                     $lokasi_before=$lokasi_before_query->nm_m_branch_company."-".$lokasi_before_query->m_company->nm_m_company;
    //                 } else {


    //                     $lokasi_before='';
    //                 }


    //                 return response()->json([
    //                     'status'  => false,
    //                     'message'  => 'Maaf, anda tidak bisa melakukan booking karena seluruh proses medical Checkup anda telah selesai pada <br> <b>Lokasi: '.$lokasi_before.'</b><br><b>Tanggal: '.$date_mcu.'</b><br>Terimakasih',
    //                 ]);
    //             }





    //     //}

    //      //End Off Pengecekan untuk tipe walkin harus melalui proses booking terlebih dahulu


    //         return response()->json([
    //             'status'  => true,
    //             'data' => [
    //                 0 => $cek->nip_m_employee,
    //                 1 => $cek->nm_m_employee,
    //                 // 2 => $cek->dob_m_employee ? \Carbon\Carbon::createFromFormat('Y-m-d',$cek->dob_m_employee)->isoFormat('D MMMM YYYY') : null,
    //                 2 => $cek->dob_m_employee ? \Carbon\Carbon::createFromFormat('Y-m-d',$cek->dob_m_employee)->format('d-m-Y') : null,

    //                 3 => $cek->address_m_employee,
    //                 4 => $cek->id_m_employee,
    //                 5 => $cek->hp_m_employee,
    //                 6 => $cek->email_m_employee
    //             ],
    //         ]);
	// 	}else{
    //         /**
    //          * search by NIPK
    //          */
    //         $cek2 = M_employee::where('nipk_m_employee', $request->nip_m_employee)->first();
    //         if($cek2){
    //             return response()->json([
    //                 'status'  => true,
    //                 'data' => [
    //                     0 => $cek2->nip_m_employee,
    //                     1 => $cek2->nm_m_employee,
    //                     2 => $cek2->dob_m_employee ? \Carbon\Carbon::createFromFormat('Y-m-d',$cek2->dob_m_employee)->isoFormat('D MMMM YYYY') : null,
    //                     3 => $cek2->address_m_employee,
    //                 ],
    //             ]);
    //         }

    //         /**
    //          * DATA EMPLOYEE NOT FOUND
    //          */

    //         return response()->json([
    //             'status'  => false,
    //             'message'  => 'Invalid NIP !',
    //         ]);
    //     }


    // }



    // public function checkin(Request $request)
    // {
    //     $messages = [
    //         // 'id_m_branch.required' => '* pilih salah satu cabang (choose branch)',
    //         // 'dob_m_employee.required' => '* masukkan tanggal lahir Anda (pick your date of birth)',
    //         // 'email_m_employee.required' => '* masukkan alamat email (fill your email address)',
    //         // 'email_m_employee.email' => '* alamat email tidak valid (email address is invalid)',
    //         // 'arrival_date.required' => '* pilih tanggal reservasi (choose reservation date)',
    //         // 'hp.required' => '* masukkan nomor whatsApp (fill your whatsapp phone number)',
    //         // 'hp.numeric' => '* nomor whatsapp harus berupa angka (numeric input only)',
    //         'no_reg_modal.required' => '* masukkan nomor registrasi anda (please fill Your Registration Number)',
    //     ];

    //     $validator = Validator::make($request->all(), [
    //         // 'id_m_branch' => ['required'],
    //         // 'arrival_date' => ['required'],
    //         // 'hp' => ['required', 'numeric', 'min:10'],
    //         // 'dob_m_employee' => ['required'],
    //         'no_reg_modal' => ['required'],
    //     ], $messages);


    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return response()->json([
    //             'error' => [
    //                 // 'id_m_branch' => $errors->first('id_m_branch'),
    //                 // 'arrival_date' => $errors->first('arrival_date'),
    //                 // 'hp' => $errors->first('hp'),
    //                 // 'dob_m_employee_modal' => $errors->first('dob_m_employee'),
    //                 'no_reg_modal' => $errors->first('no_reg_modal'),
    //             ]
    //         ]);
    //     }


    //     $nip = $request->nip_m_employee;
    //     $id_t_qrcode = $request->id_t_qrcode;

    //     $id_m_employee = $request->id_m_employee;
    //     $nip_m_employee = $request->nip_m_employee_hidden;
    //     $id_m_branch = $request->id_m_branch;
    //     $arrival_date = $request->arrival_date;
    //     $hp = $request->hp;
    //     $nip_m_employee_hidden = $request->nip_m_employee_hidden;

    //     // $find = M_employee::where('nip_m_employee', $nip)->orderby('id_m_employee','DESC')->first();
    //     //  \DB::enablequerylog();
    //     $find = M_employee::where('id_m_employee',  $id_m_employee)->first();
    //   //  \DB::enablequerylog();
    //     // $cek_data_booking=T_booking::with('m_branch','m_employee')->where('nip_m_employee',$nip)->wherenull('status_booking')->first();
    //     $cek_data_booking=T_booking::with('m_branch','m_employee')->where('id_m_employee',$id_m_employee)->wherenull('status_booking')->first();
    //     //dd(\DB::getquerylog());

    //     if ($cek_data_booking){


    //         $cek_data_booking->status_booking='CHECKIN';
    //         $cek_data_booking->save();
    //     }

    //    // dd($request->no_reg_modal);

    //     if($find){
    //         if(
    //             // T_mcus::where('id_m_employee', $find->id_m_employee)
    //             // ->where('id_t_qrcode', $id_t_qrcode)
    //             // ->count() == 0

    //             T_mcus::where('id_m_employee', $find->id_m_employee)
    //             ->where('id_t_qrcode', $id_t_qrcode)->wherenull('time_out')
    //             ->count() == 0
    //         ){
    //             $new_mcu = new T_mcus();
    //             $new_mcu->id_t_mcu = T_mcus::maxId();
    //             $new_mcu->id_t_qrcode = $id_t_qrcode;
    //             $new_mcu->id_m_employee = $find->id_m_employee;
    //             $new_mcu->nip_m_employee = $find->nip_m_employee;
    //             $new_mcu->no_reg = trim($request->no_reg_modal);
    //             $new_mcu->time_in = now();
    //             $new_mcu->save();
    //         }else{
    //             // $upd = T_mcus::where('id_m_employee', $find->id_m_employee)
    //             //         ->where('id_t_qrcode', $id_t_qrcode)->first();
    //             $upd = T_mcus::where('id_m_employee', $find->id_m_employee)
    //             ->where('id_t_qrcode', $id_t_qrcode)->wherenull('time_out')->first();
    //             $upd->time_in = now();
    //             $upd->time_out = null;
    //             $upd->no_reg = trim($request->no_reg_modaL);
    //             $upd->save();
    //         }

    //      //  \DB::enablequerylog();
    //         $update_emp = M_employee::where('id_m_employee', $id_m_employee)->first();
    //       // dd(\DB::getquerylog());
    //         if($update_emp)
    //         {
    //             $update_emp->dob_m_employee = ($request->filled('dob_m_employee')) ? Carbon::createFromFormat('d-m-Y',$request->dob_m_employee)->format('Y-m-d') : null;
    //             $update_emp->email_m_employee = $request->email_m_employee;
    //             $update_emp->hp_m_employee = $request->hp;
    //             $update_emp->save();
    //         }

    //         $html = '<strong>Check In Success !</strong>
    //                 <br>Time : '.\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',now())->isoFormat('D MMMM YYYY H:m:s').' WIB<br>
    //                 Emp. ID : '.$nip.'<br>
    //                 Emp. Name : '.$find->nm_m_employee;

    //         return response()->json([
    //             'status'  => true,
    //             'html'  => $html,
    //         ]);

    //     }else{
    //         return response()->json([
    //             'status'  => false,
    //             'message'  => 'Invalid NIP !',
    //         ]);
    //     }
    // }


}
