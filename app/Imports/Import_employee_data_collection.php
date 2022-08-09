<?php
namespace App\Imports;

use App\Models\M_branch_company;
use App\Models\M_employee;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithStartRow;

// HeadingRowFormatter::default('none');

class Import_employee_data_collection implements ToCollection,WithStartRow
{

    protected $id_m_project;
    public function __construct($project)
    {
        $this->id_m_project = $project;
    }


    use Importable;
    public function startRow(): int
    {
        return 3;
    }


    public function collection(Collection $rows)
    {

        @ini_set('max_execution_time', 0);

        $bc = [];
        foreach ($rows as $row)
        {

            // array_push($bc, $row[12]);
            //Untuk Insert M_branch_company

            // $cek_branch=M_branch_company::where('nm_m_branch_company','=',$row[12])->first();
            // dd($cek_branch);

            // dd(\DB::getquerylog());
          // if ($cek_branch == null){
                // M_branch_company::create([
                //     'id_m_branch_company' => M_branch_company::maxId(),
                //     'nm_m_branch_company' => $row[12],
                //     'basetown_city' => $row[15],
                //     'business_unit' => $row[7],
                //     'address_m_branch_company' => $row[21],
                // ]);

                // $object = new M_branch_company();
                // $object->id_m_branch_company = M_branch_company::MaxId();
                // $object->nm_m_branch_company = $row[12];
                // $object->basetown_city = $row[15];
                // $object->business_unit = $row[7];
                // $object->address_m_branch_company = $row[21];
                // $object->save();

           //}


             //end of Untuk Insert M_branch_company

//   \DB::enablequerylog();

            // $if_exists = M_employee::where('year_m_employee', date('Y'))->where('nip_m_employee', $row['0'])->where('id_m_project',$this->id_m_project)->first();
            $if_exists = M_employee::where('year_m_employee', date('Y'))->where('nip_m_employee','=', "'".$row['0']."'")->where('id_m_project',$this->id_m_project)->first();
//  dd(\DB::getquerylog());

            if($row and $if_exists==null and $row[0]){


            M_employee::create([
                'id_m_employee' => M_employee::maxId(),
                'nip_m_employee' => $row[0],
                'nipk_m_employee' => $row[1],
                'nm_m_employee' => $row[2],
                'status_m_employee' => $row[3],
                'group_m_employee' => $row[4],
                'cost_center_m_employee' => $row[5],
                'position_m_employee' => $row[6],
                'business_unit_m_employee' => $row[7],
                'department_m_employee' => $row[8],
                'level_3_m_employee' => $row[9],
                'level_4_m_employee' => $row[10],
                'level_5_m_employee' => $row[11],
                'basetown_m_employee' => $row[12],
                'gender_m_employee' => $row[13],
                'age_classification_m_employee' => $row[14],
                'basetown_city_m_employee' => $row[15],//mulai arek iki gak gelem melbu
                'email_m_employee' => strtolower(strtoupper($row[16])),

                'grade_m_employee' => $row[17],
                'masa_kerja_m_employee' => $row[18],
                'level_2_m_employee' => $row[19],
                'level_6_m_employee' => $row[20],
                'business_address_m_employee' => $row[21],
                'business_address_2_m_employee' => $row[22],
                'postal_code_m_employee' => $row[23],
                'strc_id_m_employee' => $row[24],
                'strc_name_m_employee' => $row[25],
                'strc_position_m_employee' => $row[26],
                'dept' => $row[27],
                'lead_m_employee' => $row[28],
                'area_m_employee' => ($row[29]) ? $row[29] : null,
                'con_m_employee' => ($row[30]) ? $row[30] : null,
                'paket_m_employee' => ($row[31]) ? $row[31] : null,
                'scope_m_employee' => ($row[32]) ? $row[32] : null,
                'nm_paket_m_employee' => $row[33],
                'kd_paket_m_employee' => $row[34],

                'id_m_mcu_category' => $row[34],
                'dob_m_employee' => ($row[38]) ? Carbon::createFromFormat('d-m-Y', $row[38])->format('Y-m-d') : null,
                'year_m_employee' => date('Y'),
                'id_m_project' => $this->id_m_project,
                'hasil_import' => '1',

                // ($row[35]) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[35])) : null,

            ]);

        }else  if($row and $if_exists!=null and $row[0]){

            try{


                M_employee::where('nip_m_employee', $row[0])->update([
                    'nipk_m_employee' => $row[1],
                        'nm_m_employee' => $row[2],
                        'status_m_employee' => $row[3],
                        'group_m_employee' => $row[4],
                        'cost_center_m_employee' => $row[5],
                        'position_m_employee' => $row[6],
                        'business_unit_m_employee' => $row[7],
                        'department_m_employee' => $row[8],
                        'level_3_m_employee' => $row[9],
                        'level_4_m_employee' => $row[10],
                        'level_5_m_employee' => $row[11],
                        'basetown_m_employee' => $row[12],
                        'gender_m_employee' => $row[13],
                        'age_classification_m_employee' => $row[14],
                        'basetown_city_m_employee' => $row[15],
                        'email_m_employee' => $row[16],
                        'grade_m_employee' => $row[17],
                        'masa_kerja_m_employee' => $row[18],
                        'level_2_m_employee' => $row[19],
                        'level_6_m_employee' => $row[20],
                        'business_address_m_employee' => $row[21],
                        'business_address_2_m_employee' => $row[22],
                        'postal_code_m_employee' => $row[23],
                        'strc_id_m_employee' => $row[24],
                        'strc_name_m_employee' => $row[25],
                        'strc_position_m_employee' => $row[26],
                        'dept' => $row[27],
                        'lead' => $row[28],
                        'area_m_employee' => $row[29],
                        'lead_m_employee' => $row[30],
                        'paket_m_employee' => $row[31],
                        'scope_m_employee' => $row[32],
                        'nm_paket_m_employee' => $row[33],
                        'kd_paket_m_employee' => $row[34],
                        'id_m_mcu_category' => $row[34],

                        'year_m_employee' => date('Y'),
                        'id_m_project' => $this->id_m_project,
                        'hasil_import' => '2',



                ]);


                // dump(\DB::getquerylog());
            }catch(\Exception $e){
                return false;
            }


        }else{

        }//end of exist


    }



    }




    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'nip_m_employee';
    }

}
