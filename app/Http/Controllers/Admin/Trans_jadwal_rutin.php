<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\M_app;
use App\Models\M_menu;
use App\Models\M_proses;
use App\Models\T_log_proses;
use App\Models\T_reservasi;
use App\Models\M_interval;
use Illuminate\Http\Request;
use App\Models\T_group_content;
use App\Models\T_reservasi_det;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\T_jadwal_rutin;
use App\Models\T_jadwal_rutin_det;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Datatables\Datatables;

class Trans_jadwal_rutin extends Controller
{

    public function index()
    {
        $data = [
            'head_title' => 'Jadwal Rutin',
            'page_title' => 'Jadwal Rutin',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Jadwal Rutin',
        ];

        return view('admin.t_jadwal_rutin.index')->with($data);
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $query = T_jadwal_rutin::with(['t_jadwal_rutin_det'])->orderBy('urut_t_jadwal_rutin')->get();
            $data  = [];
            foreach ($query as $key => $val) {
                // dd($val, $val->id_t_reservasi, $val->m_proses->nm_m_proses);
                $obj = new \stdClass;
                // $obj->no = $key+1;
                $obj->id_t_jadwal_rutin = $val->id_t_jadwal_rutin;
                $obj->hari = $val->hari;
                $obj->status = ($val->status == 1) ? 'Active' : 'Nonactive';
                $obj->sesi = (function () use ($val) {
                    $str = '';

                    if($val->t_jadwal_rutin_det->isNotEmpty()) {
                        $str = '<ul>';
                        foreach ($val->t_jadwal_rutin_det as $key => $value) {
                            $str .= '<li>sesi '.$value->sesi.' : '.$value->pukul.'</li>';
                        }

                        $str .= '</ul>';
                    }

                    return $str;
                })();
                ### wajib menggunakan nama object action
                $obj->action = '<div class="btn-group">
                                <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                    <a class="dropdown-item setDetail" data-id_t_jadwal_rutin="'.$val->id_t_jadwal_rutin.'" href="javascript:void(0)">Set Detail</a>
                                    <a class="dropdown-item edit" data-id_t_jadwal_rutin="'.$val->id_t_jadwal_rutin.'" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>';
                // $val->created_at = Carbon::now();
                // $val->updated_at = Carbon::now();
                $data[] = $obj;
            }

            $datatable = new Collection($data);

            return Datatables::of($datatable)->addIndexColumn()->rawColumns(['action', 'sesi'])->make(true);
        }
    }

    public function edit_modal(Request $request)
    {
        $query = T_jadwal_rutin::where('id_t_jadwal_rutin', $request->id_t_jadwal_rutin)->firstOrFail();
        $data = [
            'head_title' => 'Jadwal Rutin',
            'page_title' => 'Jadwal Rutin',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Jadwal Rutin',
            'old' => $query,
            'arr_hari' => [
                1 => 'senin',
                2 => 'selasa',
                3 => 'rabu',
                4 => 'kamis',
                5 => 'jumat',
                6 => 'sabtu',
                7 => 'minggu'
            ]
        ];

        return view('admin.t_jadwal_rutin.edit_modal')->with($data);
    }

    public function update(Request $request)
    {
        $messages = [
            'hari.required' => 'please choose one',
        ];

        $validator = Validator::make($request->all(), [
            'hari' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'hari' => $errors->first('hari'),
                ]
            ]);
        }

        DB::beginTransaction();
        $update = T_jadwal_rutin::where([
            'id_t_jadwal_rutin' => $request->id_t_jadwal_rutin,
        ])->first();

        if($update == null) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'hari' => 'Data not found !',
                ]
            ]);
        }

        $arr_hari = [
            1 => 'senin',
            2 => 'selasa',
            3 => 'rabu',
            4 => 'kamis',
            5 => 'jumat',
            6 => 'sabtu',
            7 => 'minggu'
        ];

        $update->hari = $arr_hari[$request->hari];
        $update->urut_t_jadwal_rutin = $request->hari;
        $update->status = ($request->status == '1') ? $request->status : null;
        $update->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        try{
            $update->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Updated',
                'redirect' => route('admin.t_jadwal_rutin.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function set_detail_modal(Request $request)
    {
        $query = T_jadwal_rutin::with(['t_jadwal_rutin_det'])->where('id_t_jadwal_rutin', $request->id_t_jadwal_rutin)->firstOrFail();

        $data = [
            'head_title' => 'Jadwal Rutin',
            'page_title' => 'Jadwal Rutin',
            'parent_menu_active' => 'Transaksi',
            'child_menu_active'   => 'Jadwal Rutin',
            'old' => $query,
            'arr_hari' => [
                1 => 'senin',
                2 => 'selasa',
                3 => 'rabu',
                4 => 'kamis',
                5 => 'jumat',
                6 => 'sabtu',
                7 => 'minggu'
            ]
        ];

        return view('admin.t_jadwal_rutin.set_detail_modal')->with($data);
    }

    public function add_detail(Request $request)
    {
        // dd($request->all());
        $messages = [
            'sesi.required' => 'please fill this field',
            'pukul.required' => 'please fill this field',
        ];

        $validator = Validator::make($request->all(), [
            'sesi' => ['required'],
            'pukul' => ['required'],

        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'sesi' => $errors->first('sesi'),
                    'pukul' => $errors->first('pukul'),
                ]
            ]);
        }

        // cek exist
        $cek = T_jadwal_rutin::where(['id_t_jadwal_rutin' => $request->id_t_jadwal_rutin])->first();

        if(!$cek) {
            return response()->json([
                'message' => 'Transaction invalid, please check again',
                'status'  => false,
            ]);
        }

        // cek sesi
        $cek_sesi = T_jadwal_rutin_det::where(['id_t_jadwal_rutin' => $request->id_t_jadwal_rutin, 'sesi' => $request->sesi])->first();

        if($cek_sesi) {
            $errors = $validator->errors();
            return response()->json([
                'error' => [
                    'sesi' => 'Sesi '.$request->sesi.' sudah ada !',
                ]
            ]);
         }


        DB::beginTransaction();
        $object = new T_jadwal_rutin_det;
        $object->id_t_jadwal_rutin_det = T_jadwal_rutin_det::MaxId();
        $object->id_t_jadwal_rutin = $request->id_t_jadwal_rutin;
        $object->sesi = $request->sesi;
        $object->pukul = $request->pukul.':00';
        $object->created_at = Carbon::now()->format('Y-m-d H:i:s');

        try{

            $object->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data Saved',
                'id' => $request->id_t_jadwal_rutin,
                // 'redirect' => route('admin.t_content.index'),
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }

    }

    public function delete_detail(Request $request)
    {
        if(!$request->filled('id_t_jadwal_rutin_det')){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $find = T_jadwal_rutin_det::with('t_jadwal_rutin')->where([
            'id_t_jadwal_rutin_det' => $request->id_t_jadwal_rutin_det
        ])->first();


        if($find == null){
            return response()->json([
                'message' => 'parameter invalid !',
                'status'  => false,
            ]);
        }

        $id_jadwal = $find->t_jadwal_rutin->id_t_jadwal_rutin;

        DB::beginTransaction();

        try{
            $find->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'id' => $id_jadwal,
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => false,
            ]);
        }
    }

    public function load_html_table(Request $request)
    {
        $id_jadwal = $request->id_jadwal;
        $query = T_jadwal_rutin_det::where('id_t_jadwal_rutin', $id_jadwal)->orderBy('sesi')->get();
        $html = '';

        if($query->isNotEmpty()) {
            foreach ($query as $key => $item) {
                $html .= '<tr>';

                $html .= '
                    <td>'.$item->sesi.'</td>
                    <td>'.$item->pukul.'</td>
                    <td>
                        <button class="btn btn-outline-danger text-nowrap px-1" type="button" onclick="deleteDetail(\''.$item->id_t_jadwal_rutin_det.'\')">
                            <span>Delete</span>
                        </button>
                    </td>';

                $html .= '</tr>';
            }
        }

        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }
}
