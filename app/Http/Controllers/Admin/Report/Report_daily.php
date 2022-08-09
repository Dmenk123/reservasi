<?php

namespace App\Http\Controllers\Admin\Report;

use DB;
use PDF;
use \Carbon\Carbon;
use App\Models\M_faq;
use App\Models\M_kabko;
use App\Models\T_permohonan_vitamin;
use App\Http\Controllers\Controller;
use App\Models\M_branch;
use App\Models\M_branch_company;
use App\Models\M_company;
use App\Models\M_entity;
use App\Models\M_hak_akses;
use App\Models\M_profession;
use App\Models\M_project;
use App\Models\M_project_det;
use App\Models\T_emp_request_rct;
use App\Models\T_mcus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Report_daily extends Controller
{

    public function index()
    {
        $m_company = M_company::orderBy('nm_m_company')->where('active_m_company', 'ACTIVE')->get();
        $id_m_branch = M_branch::orderBy('nm_m_branch')->where('active_m_branch', 'ACTIVE')->get();
        $id_m_branch_company = M_branch_company::orderBy('nm_m_branch_company')->where('active_m_branch_company', 'ACTIVE')->get();
        $id_m_project = M_project::orderBy('nm_m_project')->where('active_m_project', 'ACTIVE')->get();
        $data = [
            'head_title' => 'Daily Report',
            'page_title' => 'Daily Report',
            'parent_menu_active' => 'Report',
            'child_menu_active'   => 'Report Page',
            'm_company' => $m_company,
            'id_m_branch' => $id_m_branch,
            'id_m_branch_company' => $id_m_branch_company,
            'id_m_project' => $id_m_project,

        ];
    	return view('admin.report.daily.index', $data);
    }

    public function iframe()
    {
        return view('admin.report.daily.iframe');
    }

    public function pdf()
    {
        $filter_by_profession = request()->filled('id_m_profession') ? request()->get('id_m_profession') : '';
        $filter_by_entity = request()->filled('id_m_entity') ? request()->get('id_m_entity') : '';
        $filter_by_branch = request()->filled('id_m_branch') ? request()->get('id_m_branch') : '';

        $table = T_emp_request_rct::orderByDesc('id_t_emp_request_rct')
                ->when($filter_by_profession != '', function($query) use ($filter_by_profession){
                    $query->where('id_m_profession', $filter_by_profession);
                })
                ->when($filter_by_entity != '', function($query) use ($filter_by_entity){
                    $query->whereHas('branch', function($query) use ($filter_by_entity){
                        $query->where('id_m_entity', $filter_by_entity);
                    });
                })
                ->when($filter_by_branch != '', function($query) use ($filter_by_branch){
                    $query->where('id_m_branch', $filter_by_branch);
                })
                ->with('profession','education_level')
                 ->withCount('applicant')
                 ->with('branch', function($query){
                     $query->with('entity');
                 })->get();

        $data = [
            'table' => $table,
        ];
        $pdf = PDF::loadView('admin.report.daily.print_pdf', $data);
        $pdf->setPaper('Legal', 'landscape');
        return $pdf->stream("Applicant_Summary_".time().".pdf", array("Attachment" => false));

    }

    public function datatable(Request $request)
    {
        $start1 = $request->start1;
        $start2 = $request->start2;
        $gabung_tgl = $start1.'~'.$start2;
        $id_m_company = $request->id_m_company;
        $id_m_branch_company = $request->id_m_branch_company;
        $tipe_t_qrcode = $request->tipe_t_qrcode;
        $id_m_branch = $request->id_m_branch;
        $id_m_branch_pelaksana = $request->id_m_branch_pelaksana;
        $complete_status = $request->complete_status;
        $id_m_branch_company_basetown = $request->id_m_branch_company_basetown;
        $id_m_project = $request->id_m_project;


       // \DB::enablequerylog();



                $table=\DB::table('t_mcu')
                ->leftjoin('m_employee','t_mcu.id_m_employee','=','m_employee.id_m_employee')
                ->leftjoin('t_qrcode','t_mcu.id_t_qrcode','=','t_qrcode.id_t_qrcode')
                ->leftjoin('m_branch','t_qrcode.id_m_branch','=','m_branch.id_m_branch')
                ->leftjoin('m_branch_company','t_qrcode.id_m_branch_company','=', 'm_branch_company.id_m_branch_company')
                ->leftjoin('m_company','m_branch_company.id_m_company','=', 'm_company.id_m_company')
                ->leftjoin('m_branch as m_branch_pelaksana','t_qrcode.id_m_branch_pelaksana','=','m_branch_pelaksana.id_m_branch')
                ->when($start1 != '' and $start2 != '', function($query) use ($gabung_tgl){
                    $extract = explode('~',$gabung_tgl);
                    $start1_ok = $extract[0];
                    $start2_ok = $extract[1];
                    $query->whereDate('t_mcu.time_in', '>=', Carbon::createFromFormat('d-m-Y', $start1_ok)->format('Y-m-d'));
                    $query->whereDate('t_mcu.time_in', '<=', Carbon::createFromFormat('d-m-Y', $start2_ok)->format('Y-m-d'));
                })
                ->when($request->filled('id_m_company'), function($query) use ($id_m_company){
                    $query->where('m_branch_company.id_m_company', $id_m_company);
                })
                ->when($request->filled('id_m_branch_company'), function($query) use ($id_m_branch_company){
                    $query->where('t_qrcode.id_m_branch_company', $id_m_branch_company);
                })
                ->when($request->filled('complete_status') and $complete_status!='BELUM CHECKOUT', function($query) use ($complete_status){
                    $query->where('keterangan',$complete_status);
                })
                ->when($request->filled('complete_status') and $complete_status=='BELUM CHECKOUT', function($query) use ($complete_status){
                    $query->wherenull('keterangan');
                })
                ->when($request->filled('id_m_branch'), function($query) use ($id_m_branch){
                    $query->where('t_qrcode.id_m_branch', $id_m_branch);
                })
                ->when($request->filled('id_m_branch_company_basetown'), function($query) use ($id_m_branch_company_basetown){
                    $query->where('m_employee.basetown_m_employee',$id_m_branch_company_basetown);
                })

                ->when($request->filled('id_m_project'), function($query) use ($id_m_project){
                    $query->where('m_employee.id_m_project', $id_m_project);
                })

                ->when($request->filled('tipe_t_qrcode'), function($query) use ($tipe_t_qrcode){
                    $query->where('t_qrcode.tipe_t_qrcode', $tipe_t_qrcode);
                })
                ->when($request->filled('id_m_branch_pelaksana'), function($query) use ($id_m_branch_pelaksana){
                    $query->where('t_qrcode.id_m_branch_pelaksana', $id_m_branch_pelaksana);
                })
                ->select('m_branch_pelaksana.nm_m_branch as nm_m_branch_pelaksana','m_employee.business_unit_m_employee','m_employee.basetown_m_employee','m_branch_company.nm_m_branch_company', 'm_company.nm_m_company','m_branch.nm_m_branch','m_employee.nip_m_employee','m_employee.nm_m_employee','t_qrcode.tipe_t_qrcode','t_mcu.no_reg','t_qrcode.id_m_branch','t_qrcode.id_m_branch_company','t_mcu.time_in')->get();

                ;
        // dd($table);

      //  dd(\DB::getquerylog());

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {



            if ($value->id_m_branch){

                $location_name=$value->nm_m_branch;
            }else if ($value->id_m_branch_company){


                $location_name=$value->nm_m_branch_company." - ". $value->nm_m_company;

            }else {

                $location_name='-';
            }
    		$datas[$key][] = $i++;
    		$datas[$key][] = $value->nm_m_branch_pelaksana;
    		$datas[$key][] = $value->business_unit_m_employee." - ".$value->basetown_m_employee;
            $datas[$key][] = $location_name;
    		$datas[$key][] = $value->nip_m_employee;
    		$datas[$key][] = $value->nm_m_employee;
            // $datas[$key][] = ($value->time_in) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_in)->isoFormat('D MMMM YYYY H:mm:s') : '-';
            $datas[$key][] = ($value->time_in) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_in)->Format('d-m-Y H:m:s') : '-';
    		$datas[$key][] = $value->no_reg;
    		$datas[$key][] = $value->tipe_t_qrcode;
    	}

    	$data = [
    		'data' => $datas
    	];

    	return response()->json($data);
    }


    public function load_branch_by_company(Request $request)
    {
        $id_m_company = $request->id_m_company;
        if($id_m_company != ''){
            $branch = M_branch_company::where('id_m_company', $id_m_company)->orderBy('nm_m_branch_company')->where('active_m_branch_company', 'ACTIVE')->get();
            $html = '';
            $html .= '<option value="">All Branches</option>';
            foreach($branch as $b){
                $html .= '<option value="'.$b->id_m_branch_company.'">'.$b->nm_m_branch_company.'</option>';
            }
            return response()->json([
                'status' => true,
                'html' => $html,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'html' => null,
            ]);
        }
    }


    public function load_company_by_project(Request $request)
    {
        $id_m_project = $request->id_m_project;

        if($id_m_project != ''){
            // $branch = M_project_det::with('m_company')->where('id_m_project', $id_m_project)->orderBy('nm_m_company')->where('m_company.active_m_branch_company', 'ACTIVE')->get();
           //\DB::enablequerylog();
            $company = M_project_det::join('m_company','m_project_det.id_m_company','=','m_company.id_m_company')->where('id_m_project', $id_m_project)->where('m_company.active_m_company', 'ACTIVE')->orderBy('m_company.nm_m_company')->get();

            //dd(\DB::getquerylog());
            $html = '';
            $html .= '<option value="">All Company</option>';
            foreach($company as $b){
                $html .= '<option value="'.$b->id_m_company.'">'.$b->nm_m_company.'</option>';
            }
            return response()->json([
                'status' => true,
                'html' => $html,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'html' => null,
            ]);
        }
    }


    public function download_xls(Request $request)
    {
        $start1 = $request->start1;
        $start2 = $request->start2;
        $gabung_tgl = $start1.'~'.$start2;
        $id_m_company = $request->id_m_company;
        $id_m_branch_company = $request->id_m_branch_company;
        $tipe_t_qrcode = $request->tipe_t_qrcode;
        $id_m_branch = $request->id_m_branch;
        $id_m_branch_pelaksana = $request->id_m_branch_pelaksana;
        $complete_status = $request->complete_status;
        $id_m_branch_company_basetown = $request->id_m_branch_company_basetown;
        $id_m_project = $request->id_m_project;


       // \DB::enablequerylog();
        // $table = T_mcus::orderByDesc('updated_at')
        //         ->when($start1 != '' and $start2 != '', function($query) use ($gabung_tgl){
        //             $extract = explode('~',$gabung_tgl);
        //             $start1_ok = $extract[0];
        //             $start2_ok = $extract[1];
        //             $query->whereDate('time_in', '>=', Carbon::createFromFormat('d-m-Y', $start1_ok)->format('Y-m-d'));
        //             $query->whereDate('time_in', '<=', Carbon::createFromFormat('d-m-Y', $start2_ok)->format('Y-m-d'));
        //         })
        //         ->when($request->filled('id_m_company'), function($query) use ($id_m_company){
        //             $query->whereHas('t_qrcode', function($query) use ($id_m_company){
        //                 $query->whereHas('m_branch_company', function($query) use ($id_m_company){
        //                     $query->where('id_m_company', $id_m_company);
        //                 });
        //             });
        //         })
        //         ->when($request->filled('id_m_branch_company'), function($query) use ($id_m_branch_company){
        //             $query->whereHas('t_qrcode', function($query) use ($id_m_branch_company){
        //                 $query->where('id_m_branch_company', $id_m_branch_company);
        //             });
        //         })
        //         // ->when($request->filled('complete_status'), function($query) use ($complete_status){
        //         //     $query->where('keterangan',$complete_status);
        //         // })
        //         ->when($request->filled('complete_status') and $complete_status!='BELUM CHECKOUT', function($query) use ($complete_status){
        //             $query->where('keterangan',$complete_status);
        //         })
        //         ->when($request->filled('complete_status')and $complete_status=='BELUM CHECKOUT', function($query) use ($complete_status){
        //             $query->wherenull('keterangan');
        //         })
        //         ->when($request->filled('id_m_branch'), function($query) use ($id_m_branch){
        //             $query->whereHas('t_qrcode', function($query) use ($id_m_branch){
        //                 $query->where('id_m_branch', $id_m_branch);
        //             });
        //         })

        //         ->when($request->filled('id_m_branch_pelaksana'), function($query) use ($id_m_branch_pelaksana){
        //             $query->whereHas('t_qrcode', function($query) use ($id_m_branch_pelaksana){
        //                 $query->where('id_m_branch_pelaksana', $id_m_branch_pelaksana);
        //             });
        //         })
        //         ->when($request->filled('id_m_branch_company_basetown'), function($query) use ($id_m_branch_company_basetown){
        //             $query->whereHas('m_employee', function($query) use ($id_m_branch_company_basetown){
        //                 $query->where('basetown_m_employee', $id_m_branch_company_basetown);
        //             });
        //         })
        //         ->when($request->filled('tipe_t_qrcode'), function($query) use ($tipe_t_qrcode){
        //             $query->whereHas('t_qrcode', function($query) use ($tipe_t_qrcode){
        //                 $query->where('tipe_t_qrcode', $tipe_t_qrcode);
        //             });
        //         })
        //         ->when($request->filled('id_m_project'), function($query) use ($id_m_project){
        //             $query->whereHas('m_employee', function($query) use ($id_m_project){
        //                 $query->where('id_m_project', $id_m_project);
        //             });
        //         })

        //         ->with('m_employee')
        //         ->with('t_qrcode', function($query){
        //             $query->select(['id_t_qrcode', 'tipe_t_qrcode', 'id_m_branch', 'id_m_branch_company','id_m_branch_pelaksana'])
        //                     ->with('m_branch:id_m_branch,nm_m_branch')
        //                     ->with('m_branch_company', function($query){
        //                         $query->select(['id_m_branch_company', 'nm_m_branch_company', 'id_m_company'])
        //                               ->with('m_company:id_m_company,nm_m_company');
        //                     });
        //         })->get();


        $table=\DB::table('t_mcu')
        ->leftjoin('m_employee','t_mcu.id_m_employee','=','m_employee.id_m_employee')
        ->leftjoin('t_qrcode','t_mcu.id_t_qrcode','=','t_qrcode.id_t_qrcode')
        ->leftjoin('m_branch','t_qrcode.id_m_branch','=','m_branch.id_m_branch')
        ->leftjoin('m_branch_company','t_qrcode.id_m_branch_company','=', 'm_branch_company.id_m_branch_company')
        ->leftjoin('m_company','m_branch_company.id_m_company','=', 'm_company.id_m_company')
        ->leftjoin('m_branch as m_branch_pelaksana','t_qrcode.id_m_branch_pelaksana','=','m_branch_pelaksana.id_m_branch')
        ->when($start1 != '' and $start2 != '', function($query) use ($gabung_tgl){
            $extract = explode('~',$gabung_tgl);
            $start1_ok = $extract[0];
            $start2_ok = $extract[1];
            $query->whereDate('t_mcu.time_in', '>=', Carbon::createFromFormat('d-m-Y', $start1_ok)->format('Y-m-d'));
            $query->whereDate('t_mcu.time_in', '<=', Carbon::createFromFormat('d-m-Y', $start2_ok)->format('Y-m-d'));
        })
        ->when($request->filled('id_m_company'), function($query) use ($id_m_company){
            $query->where('m_branch_company.id_m_company', $id_m_company);
        })
        ->when($request->filled('id_m_branch_company'), function($query) use ($id_m_branch_company){
            $query->where('t_qrcode.id_m_branch_company', $id_m_branch_company);
        })
        ->when($request->filled('complete_status') and $complete_status!='BELUM CHECKOUT', function($query) use ($complete_status){
            $query->where('keterangan',$complete_status);
        })
        ->when($request->filled('complete_status') and $complete_status=='BELUM CHECKOUT', function($query) use ($complete_status){
            $query->wherenull('keterangan');
        })
        ->when($request->filled('id_m_branch'), function($query) use ($id_m_branch){
            $query->where('t_qrcode.id_m_branch', $id_m_branch);
        })
        ->when($request->filled('id_m_branch_company_basetown'), function($query) use ($id_m_branch_company_basetown){
            $query->where('m_employee.basetown_m_employee',$id_m_branch_company_basetown);
        })

        ->when($request->filled('id_m_project'), function($query) use ($id_m_project){
            $query->where('m_employee.id_m_project', $id_m_project);
        })

        ->when($request->filled('tipe_t_qrcode'), function($query) use ($tipe_t_qrcode){
            $query->where('t_qrcode.tipe_t_qrcode', $tipe_t_qrcode);
        })
        ->when($request->filled('id_m_branch_pelaksana'), function($query) use ($id_m_branch_pelaksana){
            $query->where('t_qrcode.id_m_branch_pelaksana', $id_m_branch_pelaksana);
        })
        ->select('m_branch_pelaksana.nm_m_branch as nm_m_branch_pelaksana','m_employee.business_unit_m_employee','m_employee.basetown_m_employee','m_branch_company.nm_m_branch_company', 'm_company.nm_m_company','m_branch.nm_m_branch','m_employee.nip_m_employee','m_employee.nm_m_employee','t_qrcode.tipe_t_qrcode','t_mcu.no_reg','t_qrcode.id_m_branch','t_qrcode.id_m_branch_company','t_mcu.time_in','m_employee.nipk_m_employee','m_employee.cost_center_m_employee','m_employee.position_m_employee','m_employee.group_m_employee','m_employee.department_m_employee','t_mcu.id_t_mcu')->get();

        ;


               // dd(\DB::getquerylog());

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'dddddd',
                        ],
                    ],
                ];
                $styleArrayRow = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];
                $styleArrayTitle = [
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                    ],
                ];


                $sheet->setCellValue('A1', 'DAFTAR PESERTA MEDICAL CHECK UP PT HM SAMPOERNA');
                $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleArrayTitle);
                $tgl1 = ($start1) ? Carbon::createFromFormat('d-m-Y', $start1)->isoFormat('D MMMM YYYY') : '';
                $tgl2 = ($start2) ? Carbon::createFromFormat('d-m-Y', $start2)->isoFormat('D MMMM YYYY') : '';
                $gabung = ($tgl1 && $tgl2) ? $tgl1.' sampai dengan '.$tgl2 : '';
                $sheet->setCellValue('A2', $gabung);
                $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($styleArrayTitle);
                $sheet->setCellValue('A3', 'NO');
                $sheet->setCellValue('B3', 'EMPLOYEE ID');
                $sheet->setCellValue('C3', 'ID PENGENAL');
                $sheet->setCellValue('D3', 'NO. POLI');
                $sheet->setCellValue('E3', 'EMPLOYEE COSTCENTER');
                $sheet->setCellValue('F3', 'NAMA');
                $sheet->setCellValue('G3', 'DESCRIPTION POSITION');
                $sheet->setCellValue('H3', 'EMPLOYEE GROUP');
                $sheet->setCellValue('I3', 'DEPARTMENT DESCRIPTION');
                $sheet->setCellValue('J3', 'BASETOWN LOCATION');
                $sheet->setCellValue('K3', 'RECOMMENDATION FOR MEDICAL');
                $sheet->setCellValue('L3', 'REG DATE');
                $sheet->setCellValue('M3', 'REG NO');
                $sheet->setCellValue('N3', 'TYPE');

                $sheet->setCellValue('O3', 'PIC BRANCH');
                $sheet->setCellValue('P3', 'CI Location');


                $spreadsheet->getActiveSheet()->getStyle('A3:P3')->applyFromArray($styleArray);

                $rows = 4;
                $i = 1;
                foreach($table as $value){


                    if ($value->id_m_branch){

                        $location_name=$value->nm_m_branch;
                    }else if ($value->id_m_branch_company){


                        $location_name=$value->nm_m_branch_company." - ". $value->nm_m_company;

                    }else {

                        $location_name='-';
                    }

                    $sheet->setCellValue('A' . $rows,($i++));
                    $sheet->setCellValue('B' . $rows, $value->nip_m_employee);
                    $sheet->setCellValue('C' . $rows, $value->nipk_m_employee);
                    $sheet->setCellValue('D' . $rows, null);
                    $sheet->setCellValue('E' . $rows, $value->cost_center_m_employee);
                    $sheet->setCellValue('F' . $rows, $value->nm_m_employee);
                    $sheet->setCellValue('G' . $rows, $value->position_m_employee);
                    $sheet->setCellValue('H' . $rows, $value->group_m_employee);
                    $sheet->setCellValue('I' . $rows, $value->department_m_employee);
                    $sheet->setCellValue('J' . $rows, $value->basetown_m_employee);
                    $concat_grup_mcu = '';


                    if ($value->id_t_mcu){

                        $mcu=\DB::table('t_mcu_det')
                        ->leftjoin('m_group_mcu','t_mcu_det.id_m_group_mcu','=','m_group_mcu.id_m_group_mcu')
                        ->where('t_mcu_det.id_t_mcu',$value->id_t_mcu)
                        ->select('m_group_mcu.nm_m_group_mcu')->get();
                        foreach($mcu as $det){
                        $concat_grup_mcu .= $det->nm_m_group_mcu.',';
                        }

                        $concat_grup_mcu_show = substr($concat_grup_mcu,0,-1);

                    }
                    $sheet->setCellValue('K' . $rows,  $concat_grup_mcu_show);
                    $sheet->setCellValue('L' . $rows, ($value->time_in) ? Carbon::createFromFormat('Y-m-d H:i:s', $value->time_in)->format('d-m-Y H:i:s') : '');
                    $sheet->setCellValue('M' . $rows, $value->no_reg);
                    $sheet->setCellValue('N' . $rows, $value->tipe_t_qrcode);
                    $sheet->setCellValue('O' . $rows, $value->nm_m_branch_pelaksana);
                    $sheet->setCellValue('P' . $rows,  $location_name);
                    $spreadsheet->getActiveSheet()->getStyle('A'.$rows.':P'.$rows.'')->applyFromArray($styleArrayRow);
                    $rows++;
                }


                $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(30);
                $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
                $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(30);
                $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
                $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(18);
                $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
                $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
                $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
                $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(10);


                $fileName = "DAILY_REPORT_".time().".xlsx";
                $writer = new Xlsx($spreadsheet);
                $writer->save("export/".$fileName);
                header("Content-Type: application/vnd.ms-excel");
                return response()->json([
                    'status' => true,
                    'redirect' => url('/')."/export/".$fileName,
                ]);

    }
}
