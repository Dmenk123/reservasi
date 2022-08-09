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

    public function index()
    {
        // $app = M_app::where(['id_m_app' => request()->get('id_app')])->IsActive()->firstOrFail();
        // $data = [
        //     'id_m_app' => request()->get('id_app'),
        //     'id_m_user_group' => request()->get('id_user_group'),
        //     'token' => request()->get('token'),
        //     'app' => $app
        // ];

        $data = [];


        return view('web.fo.pages.home')->with($data);
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
}
