<?php

namespace App\Http\Controllers;
use DB;
use App\Models\M_user_group;
use App\Models\M_user_bo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\M_branch;
use App\Models\M_branch_company;
use App\Models\M_states;
use App\Models\M_cities;
use App\Models\M_business;
use App\Models\M_business_field;
use App\Models\M_kecamatan;
use App\Models\M_kota;
use App\Models\M_provinsi;
use App\Models\M_kelurahan;
use App\Models\M_profession;
use App\Models\M_dept;
use App\Models\M_division;
use App\Models\M_education_type;
use Illuminate\Database\Eloquent\Builder;

class My_library extends Controller
{

    public function load_state_indonesia(Request $request)
    {
        $load = M_states::where('country_id', 102)->orderBy('name', 'asc')->get();
        $html_state = '';
        $html_state .= '<option value="">Choose State / Province</option>';
        foreach($load as $s)
        {
            $html_state .= '<option value="'.$s->id.'">'.$s->name.'</option>';
        }

        return response()->json([
            'html_state' => $html_state,
        ]);
    }

    public function load_states(Request $request)
    {
        $states = M_states::where('country_id', $request->countries)->orderBy('name')->get();
        $res = '<option value="">Please choose one</option>';
        foreach ($states as  $value) {
            $res .= '<option value="'.$value->id.'" >'.$value->name.'</option>';
        }

        return response($res);
    }


    public function load_cities(Request $request)
    {
        $city = M_cities::where('country_id', $request->countries)
                    ->where('state_id', $request->states)
                    ->orderBy('name')->get();
        $res = '<option value="">Please choose one</option>';
        foreach ($city as  $value) {
            $res .= '<option value="'.$value->id.'" >'.$value->name.'</option>';
        }

        return response($res);
    }


    public function load_kota(Request $request)
    {
       //\DB::enablequerylog();
        $city = M_kota::where('id_m_provinsi', $request->id_m_provinsi)
                    ->orderBy('nm_m_kota')->get();
       // dd( \DB::getquerylog());
        $res = '<option value="">Please choose one</option>';
        foreach ($city as  $value) {
            $res .= '<option value="'.$value->id_m_kota.'" >'.$value->nm_m_kota.'</option>';
        }

        return response($res);
    }

    public function load_kecamatan(Request $request)
    {
       //\DB::enablequerylog();
        $kecamatan = M_kecamatan::where('id_m_kota', $request->id_m_kota)
                    ->orderBy('nm_m_kecamatan')->get();
       // dd( \DB::getquerylog());
        $res = '<option value="">Please choose one</option>';
        foreach ($kecamatan as  $value) {
            $res .= '<option value="'.$value->id_m_kecamatan.'" >'.$value->nm_m_kecamatan.'</option>';
        }

        return response($res);
    }


    public function load_kelurahan(Request $request)
    {

        $kelurahan = M_kelurahan::where('id_m_kecamatan', $request->id_m_kecamatan)
                    ->orderBy('nm_m_kelurahan')->get();

        $res = '<option value="">Please choose one</option>';
        foreach ($kelurahan as  $value) {
            $res .= '<option value="'.$value->id_m_kelurahan.'" >'.$value->nm_m_kelurahan.'</option>';
        }

        return response($res);
    }


    public function load_business_field(Request $request)
    {
        $entity = $request->id_m_entity;
        $business_field = M_business_field::with('m_business')->whereHas('m_business', function(Builder $query) use($entity){
            $query->where('id_m_entity', $entity)->where('active_m_business','ACTIVE');
        })->orderBy('id_m_business_field','ASC')->get();
        // $business_field = M_business::with('m_business_field')->where('id_m_entity', $request->id_m_entity)
        //             ->orderBy('id_m_business_field','ASC')->get();
        $res = '<option value="">Please choose one</option>';
        foreach ($business_field as  $value) {
            $res .= '<option value="'.$value->id_m_business_field.'" >'.$value->nm_m_business_field.'</option>';
        }

        return response($res);
    }


    public function load_branch(Request $request)
    {
        $entity = $request->id_m_entity;
        $branch = M_branch::where('id_m_entity', $entity)->where('active_m_branch','ACTIVE')
                          ->orderBy('id_m_branch','ASC')->get();
        $res = '<option value="">Please choose one</option>';
        foreach ($branch as  $value) {
            $res .= '<option value="'.$value->id_m_branch.'" >'.$value->nm_m_branch.'</option>';
        }

        return response($res);
    }


    public function load_branch_company(Request $request)
    {
        $company = $request->id_m_company;
        $branch_company = M_branch_company::where('id_m_company', $company)->where('active_m_branch_company','ACTIVE')
                          ->orderBy('id_m_branch_company','ASC')->get();
        $res = '<option value="">Please choose one</option>';
        foreach ($branch_company as  $value) {
            $res .= '<option value="'.$value->id_m_branch_company.'" >'.$value->nm_m_branch_company.'</option>';
        }

        return response($res);
    }


    public function load_education_type(Request $request)
    {
        $id_m_education_level = $request->id_m_education_level;
        // $business_field = M_business_field::with('m_business')->whereHas('m_business', function(Builder $query) use($entity){
        //     $query->where('id_m_entity', $entity)->where('active_m_business','ACTIVE');
        // })->orderBy('id_m_business_field','ASC')->get();


        $m_education_type = M_education_type::where('id_m_education_level', $id_m_education_level)
                    ->orderBy('nm_m_education_type','ASC')->get();
        $res = '<option value="">Please choose one</option>';
        foreach ($m_education_type as  $value) {
            $res .= '<option value="'.$value->id_m_education_type.'" >'.$value->nm_m_education_type.'</option>';
        }

        return response($res);
    }



    public function load_profession(Request $request)
    {

       // \DB::enablequerylog();
        $branch=    M_branch::where('id_m_branch',$request->id_m_branch)->first();

        //dd(\DB::getquerylog());
        $profession = M_profession::where('id_m_entity', $branch->id_m_entity)->where('id_m_business_field', $branch->id_m_business_field)
                    ->orderBy('nm_m_profession')->get();

        $res = '<option value="">Please choose one</option>';
        foreach ($profession as  $value) {
            $res .= '<option value="'.$value->id_m_profession.'" >'.$value->nm_m_profession.'</option>';
        }

        return response($res);


        // $dept = M_dept::where('id_m_entity', $branch->id_m_entity)
        // ->orderBy('nm_m_dept')->get();

        // // dd(\DB::getquerylog());

        // $res_dept = '<option value="">Please choose one</option>';
        // foreach ($dept as  $value) {
        // $res_dept .= '<option value="'.$value->id_m_dept.'" >'.$value->nm_m_dept.'</option>';
        // }

        // return response($res_dept);



    }



    public function load_dept(Request $request)
    {

       // \DB::enablequerylog();
        $branch=    M_branch::where('id_m_branch',$request->id_m_branch)->first();

        //dd(\DB::getquerylog());
        $dept = M_dept::where('id_m_entity', $branch->id_m_entity)
                    ->orderBy('nm_m_dept')->get();

        $res = '<option value="">Please choose one</option>';
        foreach ($dept as  $value) {
            $res .= '<option value="'.$value->id_m_dept.'" >'.$value->nm_m_dept.'</option>';
        }

        return response($res);
    }


    public function load_division(Request $request)
    {


        $branch=    M_branch::where('id_m_branch',$request->id_m_branch)->first();

        $division = M_division::where('id_m_dept', $request->id_m_dept)
                    ->orderBy('nm_m_division')->get();

        $res = '<option value="">Please choose one</option>';
        foreach ($division as  $value) {
            $res .= '<option value="'.$value->id_m_division.'" >'.$value->nm_m_division.'</option>';
        }

        return response($res);
    }

    public function load_all_provinsi(Request $request)
    {
        $get = M_provinsi::orderBy('nm_m_provinsi')->get();
        $html_provinsi = '<option value="">Please choose one</option>';
        foreach($get as $prov)
        {
            $html_provinsi .= '<option value="'.$prov->id_m_provinsi.'">'.$prov->nm_m_provinsi.'</option>';
        }

        return response()->json([
            'html_provinsi' => $html_provinsi,
        ]);
    }




}
