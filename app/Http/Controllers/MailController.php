<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\T_reservasi;
use Illuminate\Http\Request;
use App\Models\T_jadwal_rutin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Mail\LinkUploadPembayaranMail;
use Illuminate\Support\Facades\Validator;


class MailController extends Controller
{

    public function send_email_link_upload($emailTujuan = 'rizkiyuandaa@gmail.com', $collection)
    {
        Mail::to($emailTujuan)->send(new LinkUploadPembayaranMail($collection));

        if (Mail::failures()) {
           return false;
        }else{
           return true;
        }
    }


}
