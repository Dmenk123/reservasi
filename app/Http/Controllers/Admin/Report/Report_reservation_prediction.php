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
use App\Models\T_booking;
use App\Models\T_emp_request_rct;
use App\Models\T_mcus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Report_reservation_prediction extends Controller
{

    public function index()
    {
        $m_company = M_company::orderBy('nm_m_company')->where('active_m_company', 'ACTIVE')->get();
        $id_m_branch = M_branch::orderBy('nm_m_branch')->where('active_m_branch', 'ACTIVE')->get();
        $id_m_branch_company = M_branch_company::orderBy('nm_m_branch_company')->where('active_m_branch_company', 'ACTIVE')->get();
        $data = [
            'head_title' => 'Daily Report',
            'page_title' => 'Daily Report',
            'parent_menu_active' => 'Report',
            'child_menu_active'   => 'Report Page',
            'm_company' => $m_company,
            'id_m_branch' => $id_m_branch,
            'id_m_branch_company' => $id_m_branch_company,

        ];
    	return view('admin.report.reservation_prediction.index', $data);
    }

    public function iframe()
    {
        return view('admin.report.reservation_prediction.iframe');
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
        $complete_status = $request->complete_status;
        $id_m_branch_company_basetown = $request->id_m_branch_company_basetown;


      //  \DB::enablequerylog();


         //$expired_date=Carbon::createFromFormat('Y-m-d', $value->date_t_booking)->format('Y-m-d');
        // //$expired_date_tampil=Carbon::createFromFormat('Y-m-d', $value->date_t_booking)->isoFormat('D MMMM YYYY');
         $now=date('Y-m-d');


        $table = T_booking::where('date_t_booking', '>', $now)->orderByDesc('updated_at')
        ->when($start1 != '' and $start2 != '', function($query) use ($gabung_tgl){
            $extract = explode('~',$gabung_tgl);
            $start1_ok = $extract[0];
            $start2_ok = $extract[1];
            $query->whereDate('date_t_booking', '>=', Carbon::createFromFormat('d-m-Y', $start1_ok)->format('Y-m-d'));
            $query->whereDate('date_t_booking', '<=', Carbon::createFromFormat('d-m-Y', $start2_ok)->format('Y-m-d'));
        })
        // ->when($request->filled('id_m_company'), function($query) use ($id_m_company){
        //     $query->whereHas('t_qrcode', function($query) use ($id_m_company){
        //         $query->whereHas('m_branch_company', function($query) use ($id_m_company){
        //             $query->where('id_m_company', $id_m_company);
        //         });
        //     });
        // })
        // ->when($request->filled('id_m_branch_company'), function($query) use ($id_m_branch_company){
        //     $query->whereHas('t_qrcode', function($query) use ($id_m_branch_company){
        //         $query->where('id_m_branch_company', $id_m_branch_company);
        //     });
        // })
        // ->when($request->filled('complete_status') and $complete_status!='BELUM CHECKOUT', function($query) use ($complete_status){
        //     $query->where('keterangan',$complete_status);
        // })
        // ->when($request->filled('complete_status')and $complete_status=='BELUM CHECKOUT', function($query) use ($complete_status){
        //     $query->wherenull('keterangan');
        // })
        // ->when($request->filled('id_m_branch'), function($query) use ($id_m_branch){
        //     $query->whereHas('t_qrcode', function($query) use ($id_m_branch){
        //         $query->where('id_m_branch', $id_m_branch);
        //     });
        // })
        ->when($request->filled('id_m_branch_company_basetown'), function($query) use ($id_m_branch_company_basetown){
            $query->whereHas('m_employee', function($query) use ($id_m_branch_company_basetown){
                $query->where('basetown_m_employee', $id_m_branch_company_basetown);
            });
        })
        // ->when($request->filled('tipe_t_qrcode'), function($query) use ($tipe_t_qrcode){
        //     $query->whereHas('t_qrcode', function($query) use ($tipe_t_qrcode){
        //         $query->where('tipe_t_qrcode', $tipe_t_qrcode);
        //     });
        // })
        ->with('m_employee:id_m_employee,nm_m_employee,nip_m_employee,business_unit_m_employee,basetown_m_employee,position_m_employee')
        ->with('m_branch:id_m_branch,nm_m_branch')
        // ->with('t_qrcode', function($query){
        //     $query->select(['id_t_qrcode', 'tipe_t_qrcode', 'id_m_branch', 'id_m_branch_company', 'id_m_branch_pelaksana'])
        //             ->with('m_branch:id_m_branch,nm_m_branch')
        //             ->with('m_branch_company', function($query){
        //                 $query->select(['id_m_branch_company', 'nm_m_branch_company', 'id_m_company'])
        //                       ->with('m_company:id_m_company,nm_m_company');
        //             });
        // })
        ->get();
        // dd($table);

      //  dd(\DB::getquerylog());

    	$datas = [];
    	$i = 1;
    	foreach ($table as $key => $value) {

            if ($value->id_m_branch){

                $location=M_branch::where('id_m_branch', $value->id_m_branch)->first();
                $location_name=$location->nm_m_branch;
            }
            // else if ($value->t_qrcode->id_m_branch_company){

            //     $location=M_branch_company::with('m_company')->where('id_m_branch_company', $value->t_qrcode->id_m_branch_company)->first();
            //     $location_name=$location->nm_m_branch_company." - ". $location->m_company->nm_m_company;

            // }
            else {

                $location_name='-';
            }
    		$datas[$key][] = $i++;
            $datas[$key][] = ($value->id_m_branch) ? \app\Models\M_branch::where('id_m_branch',$value->id_m_branch)->first()->nm_m_branch : null;
            $datas[$key][] = $value->m_employee->business_unit_m_employee;
            $datas[$key][] = $value->m_employee->basetown_m_employee;
            $datas[$key][] = $value->m_employee->position_m_employee;
            $datas[$key][] = $value->m_employee->nip_m_employee;
    		$datas[$key][] = $value->m_employee->nm_m_employee;




           // $datas[$key][] = $location_name;

            // $datas[$key][] = ($value->time_in) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_in)->isoFormat('D MMMM YYYY H:mm:s') : '-';
            // $datas[$key][] = ($value->date_t_booking) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_in)->Format('d-m-Y H:m:s') : '-';

             $datas[$key][] = ($value->date_t_booking) ? \Carbon\Carbon::createFromFormat('Y-m-d', $value->date_t_booking)->Format('d-m-Y') : '-';
             $datas[$key][] = $value->kode_booking;
    		// $datas[$key][] = $value->no_reg;
    		// $datas[$key][] =($value->t_qrcode) ? $value->t_qrcode->tipe_t_qrcode : null;
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


    public function download_xls(Request $request)
    {
        $start1 = $request->start1;
        $start2 = $request->start2;
        $gabung_tgl = $start1.'~'.$start2;
        $id_m_company = $request->id_m_company;
        $id_m_branch_company = $request->id_m_branch_company;
        $tipe_t_qrcode = $request->tipe_t_qrcode;
        $id_m_branch = $request->id_m_branch;
        $complete_status = $request->complete_status;
        $id_m_branch_company_basetown = $request->id_m_branch_company_basetown;


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
        //         ->with('m_employee')
        //         ->with('t_qrcode', function($query){
        //             $query->select(['id_t_qrcode', 'tipe_t_qrcode', 'id_m_branch', 'id_m_branch_company'])
        //                     ->with('m_branch:id_m_branch,nm_m_branch')
        //                     ->with('m_branch_company', function($query){
        //                         $query->select(['id_m_branch_company', 'nm_m_branch_company', 'id_m_company'])
        //                               ->with('m_company:id_m_company,nm_m_company');
        //                     });
        //         })->get();

        //============================================================================================LIVE BEGIN HERE=====================

        // $expired_date=Carbon::createFromFormat('Y-m-d', $value->date_t_booking)->format('Y-m-d');
        // //$expired_date_tampil=Carbon::createFromFormat('Y-m-d', $value->date_t_booking)->isoFormat('D MMMM YYYY');
        // $now=date('Y-m-d');

        $now=date('Y-m-d');


        $table = T_booking::where('date_t_booking', '>', $now)->orderByDesc('updated_at')
        ->when($start1 != '' and $start2 != '', function($query) use ($gabung_tgl){
            $extract = explode('~',$gabung_tgl);
            $start1_ok = $extract[0];
            $start2_ok = $extract[1];
            $query->whereDate('date_t_booking', '>=', Carbon::createFromFormat('d-m-Y', $start1_ok)->format('Y-m-d'));
            $query->whereDate('date_t_booking', '<=', Carbon::createFromFormat('d-m-Y', $start2_ok)->format('Y-m-d'));
        })
        // ->when($request->filled('id_m_company'), function($query) use ($id_m_company){
        //     $query->whereHas('t_qrcode', function($query) use ($id_m_company){
        //         $query->whereHas('m_branch_company', function($query) use ($id_m_company){
        //             $query->where('id_m_company', $id_m_company);
        //         });
        //     });
        // })
        // ->when($request->filled('id_m_branch_company'), function($query) use ($id_m_branch_company){
        //     $query->whereHas('t_qrcode', function($query) use ($id_m_branch_company){
        //         $query->where('id_m_branch_company', $id_m_branch_company);
        //     });
        // })
        // ->when($request->filled('complete_status') and $complete_status!='BELUM CHECKOUT', function($query) use ($complete_status){
        //     $query->where('keterangan',$complete_status);
        // })
        // ->when($request->filled('complete_status')and $complete_status=='BELUM CHECKOUT', function($query) use ($complete_status){
        //     $query->wherenull('keterangan');
        // })
        // ->when($request->filled('id_m_branch'), function($query) use ($id_m_branch){
        //     $query->whereHas('t_qrcode', function($query) use ($id_m_branch){
        //         $query->where('id_m_branch', $id_m_branch);
        //     });
        // })
        ->when($request->filled('id_m_branch_company_basetown'), function($query) use ($id_m_branch_company_basetown){
            $query->whereHas('m_employee', function($query) use ($id_m_branch_company_basetown){
                $query->where('basetown_m_employee', $id_m_branch_company_basetown);
            });
        })
        // ->when($request->filled('tipe_t_qrcode'), function($query) use ($tipe_t_qrcode){
        //     $query->whereHas('t_qrcode', function($query) use ($tipe_t_qrcode){
        //         $query->where('tipe_t_qrcode', $tipe_t_qrcode);
        //     });
        // })
        ->with('m_employee:id_m_employee,nm_m_employee,nip_m_employee,business_unit_m_employee,basetown_m_employee,position_m_employee')
        ->with('m_branch:id_m_branch,nm_m_branch')
        // ->with('t_qrcode', function($query){
        //     $query->select(['id_t_qrcode', 'tipe_t_qrcode', 'id_m_branch', 'id_m_branch_company', 'id_m_branch_pelaksana'])
        //             ->with('m_branch:id_m_branch,nm_m_branch')
        //             ->with('m_branch_company', function($query){
        //                 $query->select(['id_m_branch_company', 'nm_m_branch_company', 'id_m_company'])
        //                       ->with('m_company:id_m_company,nm_m_company');
        //             });
        // })
        ->get();

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



                $sheet->setCellValue('A1', 'DAFTAR BOOKING PESERTA MEDICAL CHECK UP PT HM SAMPOERNA');
                $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleArrayTitle);
                $tgl1 = ($start1) ? Carbon::createFromFormat('d-m-Y', $start1)->isoFormat('D MMMM YYYY') : '';
                $tgl2 = ($start2) ? Carbon::createFromFormat('d-m-Y', $start2)->isoFormat('D MMMM YYYY') : '';
                $gabung = ($tgl1 && $tgl2) ? $tgl1.' sampai dengan '.$tgl2 : '';
                $sheet->setCellValue('A2', $gabung);
                $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($styleArrayTitle);
                $sheet->setCellValue('A3', 'NO');
                $sheet->setCellValue('B3', 'BOOKING LOCATION');
                $sheet->setCellValue('C3', 'COMPANY NAME');
                $sheet->setCellValue('D3', 'BASETOWN LOCATION');
                $sheet->setCellValue('E3', 'POSITION');
                $sheet->setCellValue('F3', 'EMPLOYEE ID');
                $sheet->setCellValue('G3', 'EMPLOYEE NAME');
                $sheet->setCellValue('H3', 'BOOKING DATE');
                $sheet->setCellValue('I3', 'BOOKING NUMBER');


                $spreadsheet->getActiveSheet()->getStyle('A3:I3')->applyFromArray($styleArray);

                $rows = 4;
                $i = 1;


                foreach($table as $value){
                    $sheet->setCellValue('A' . $rows,($i++));
                    $sheet->setCellValue('B' . $rows,  ($value->id_m_branch) ? \app\Models\M_branch::where('id_m_branch',$value->id_m_branch)->first()->nm_m_branch : null);
                    $sheet->setCellValue('C' . $rows, $value->m_employee->business_unit_m_employee);
                    $sheet->setCellValue('D' . $rows, $value->m_employee->basetown_m_employee);
                    $sheet->setCellValue('E' . $rows, $value->m_employee->position_m_employee);
                    $sheet->setCellValue('F' . $rows, $value->m_employee->nip_m_employee);
                    $sheet->setCellValue('G' . $rows, $value->m_employee->nm_m_employee);
                    $sheet->setCellValue('H' . $rows, ($value->date_t_booking) ? \Carbon\Carbon::createFromFormat('Y-m-d', $value->date_t_booking)->Format('d-m-Y') : '-');
                    $sheet->setCellValue('I' . $rows, $value->kode_booking);

                    $spreadsheet->getActiveSheet()->getStyle('A'.$rows.':I'.$rows.'')->applyFromArray($styleArrayRow);
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
                // $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
                // $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                // $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(18);
                // $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
                // $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);


                $fileName = "RESERVATION_PREDICTION_".time().".xlsx";
                $writer = new Xlsx($spreadsheet);
                $writer->save("export/".$fileName);
                header("Content-Type: application/vnd.ms-excel");
                return response()->json([
                    'status' => true,
                    'redirect' => url('/')."/export/".$fileName,
                ]);

    }
}
