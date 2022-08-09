<?php

namespace App\Http\Controllers\Web;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class Apply extends Controller
{
    public function index()
    {
        $data = [
            'head_title' => 'Apply Now',
            'page_title' => 'Apply Now',
            'child_menu_active'   => 'Apply Now',
        ];

        return view('web.apply.index')->with($data);
    }


}
