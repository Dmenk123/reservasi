<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Traits\ServiceTrait;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
 
use App\Mail\MalasngodingEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    // use ServiceTrait;
    public function __construct()
    {
        $pageTitle = "Kebutuhan";
        // View::share(compact('pageTitle'));
    }

    public function index()
    {
        // dd('tes');
        $data['data'] = 'bla bla';
        Mail::to("nurcahyono320@gmail.com")->send(new MalasngodingEmail($data));
 
		return "Email telah dikirim";
    }
   


}