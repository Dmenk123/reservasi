<?php
namespace App\Imports;

use App\Models\M_branch_company;
use App\Models\M_employee;
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

class Update_employee_data_collection implements ToCollection,WithStartRow
{
    private $rows = 0;

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


            // $if_exists = M_employee::where('year_m_employee', date('Y'))->where('nip_m_employee', $row['0'])->first();
          //  \DB::enablequerylog();
            $if_exists = M_employee::where('nip_m_employee','=',   strval($row[0]) )->first();

            if($row and $if_exists!=null and $row[0]){

            try{


                M_employee::where('nip_m_employee', strval($row[0]))->update([

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
                        //'dept' => $row[27],

                        //'area_m_employee' => $row[29],
                        //'lead_m_employee' => $row[30],

                        'scope_m_employee' => $row[32],



                        'paket_m_employee' => $row[35],

                        'nm_paket_m_employee' => $row[36],
                        'kd_paket_m_employee' => $row[37],
                        'id_m_mcu_category' => $row[37],

                        //'year_m_employee' => date('Y'),
                        'id_m_project' => $this->id_m_project,
                        'status_update' => date('Y-m-d'),
                        'id_m_user_bo' => session('logged_in.id_m_user_bo'),



                ]);


                ++$this->rows;

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

    public function getRowCount(): int
    {
        return $this->rows;
    }

}
