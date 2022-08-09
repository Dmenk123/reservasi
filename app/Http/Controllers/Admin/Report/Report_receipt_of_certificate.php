<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use App\Models\T_applicant;
use PhpOffice\PhpWord\TemplateProcessor;

class Report_receipt_of_certificate extends Controller
{
    public function iframe_report_receipt_of_certificate()
    {
        return view('admin.report.r_receipt_of_certificate.iframe');
    }

    public function pdf_report_receipt_of_certificate()
    {
        // $applicant = T_applicant::where('id_t_applicant', request()->get('id_t_applicant'))
        //              ->with('m_candidate', function($query){
        //                  $query->with('m_candidate_edu', function($query){
        //                     $query->where('last_m_candidate_edu', 'YES')->with('m_education_level');
        //                  });
        //                  $query->with('m_sex');
        //              })->firstOrFail();

        $data = [
            'applicant' => null,
        ];
        $pdf = PDF::loadView('admin.report.r_receipt_of_certificate.print_pdf', $data);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream("Employee_Receipt_of_certificate_".time().".pdf", array("Attachment" => false));

    }

}
