<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class DocsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_token(Request $request)
    {
        // dd($request->all(), 'jaranan');
        try {
            abort_if(!$request->filled('id_m_app') or !$request->filled('id_m_user_group'), 500);
            $id_m_app = $request->id_m_app;
            $id_m_user_group = $request->id_m_user_group;
            $str = openssl_random_pseudo_bytes(16);
            $token = bin2hex($str);

            DB::beginTransaction();
            ### delete all token where date is expired
            DB::table('m_token')->where('expired_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))->delete();
            ### insert new token
            DB::table('m_token')->insert([
                'id_m_token' => $token,
                'id_m_user_group' => $id_m_user_group,
                'id_m_app' => $id_m_app,
                'expired_at' => Carbon::now()->addHours(1)->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::commit();

            return response()->json([
                'message' => 'success',
                'status'  => true,
                'data' => [
                    'token' => $token
                ]
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
                'data' => null
            ]);
        }






        // try {
        //     for ($i = 0; $i < count($request->id_m_employee); $i++) {
        //         $insertLog = M_employee_work_hour_role_log::create([
        //             'id_m_work_hour_role' => $request->id_m_work_hour_role,
        //             'id_m_employee' => $request->id_m_employee[$i],
        //             'date_m_employee_work_hour_role_log' => Carbon::parse($request->date_m_employee_work_hour_role_log)->format('Y-m-d'),
        //             'id_m_user_bo' => Session::get('logged_in')['id_m_user_bo']
        //         ]);

        //         $emp = M_employee::where('id_m_employee', $request->id_m_employee[$i])->first();

        //         if (!$emp) {
        //             DB::rollback();
        //             return response()->json([
        //                 'message' => 'Terjadi kesalahan, hubungi administrator',
        //                 'status'  => false,
        //             ]);
        //         }

        //         $emp->id_m_work_hour_role = $request->id_m_work_hour_role;
        //         $emp->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        //         $emp->save();
        //     }

        //     DB::commit();
        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Data Saved',
        //         'redirect' => route('admin.attendance.set_employee_working_hour_role.index'),
        //     ]);
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return response()->json([
        //         'message' => $e->getMessage(),
        //         'status'  => false,
        //     ]);
        // }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
