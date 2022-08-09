<?php

namespace App\Http\Controllers\Admin\Report;

use DB;
use App\Models\M_faq;
use App\Models\M_kabko;
use App\Models\T_permohonan_vitamin;
use App\Http\Controllers\Controller;
use App\Models\M_hak_akses;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class Main extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'Main Activity Report and Monitoring',
            'page_title' => 'Main Activity Report and Monitoring',
            'parent_menu_active' => 'Report',
            'child_menu_active'   => 'Report Page',

        ];
    	return view('admin.report.index', $data);
    }

}