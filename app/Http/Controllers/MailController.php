<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\T_jadwal_rutin;
use App\Models\T_reservasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Mail;
use App\Mail\LinkUploadPembayaranMail;


class MailController extends Controller
{

    public function send_email_link_upload()
    {
      \Mail::to('rizkiyuandaa@gmail.com')->send(new LinkUploadPembayaranMail());

      if (\Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         }
    }


}
