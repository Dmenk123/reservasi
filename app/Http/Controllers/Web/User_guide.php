<?php

namespace App\Http\Controllers\Web;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class User_guide extends Controller
{
    public function index()
    {
        $data = [
            'head_title' => 'User Guide',
            'page_title' => 'User Guide',
            'child_menu_active'   => 'User Guide',

        ];

        return view('web.user_guide.index')->with($data);
    }


}
