<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\M_faq;
use App\Models\M_kabko;
use App\Models\T_permohonan_vitamin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class Dashboard extends Controller
{

    public function index()
    {
    	return view('admin.dashboard.index');
    }

}