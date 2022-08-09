<?php
namespace App\Imports;

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

// HeadingRowFormatter::default('none');

class Import_employee_data implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
// class Import_employee_data implements ToCollection, WithHeadingRow, WithBatchInserts,  WithUpserts
{
    protected $id_m_project;
    public function __construct($project)
    {
        $this->id_m_project = $project;
    }


    // public function collection(Collection $rows)
    // {
    //     @ini_set('max_execution_time', 0);

    //     foreach ($rows as $row)
    //     {
    //         $if_redundant = M_employee::where('year_m_employee', date('Y'))->where('nip_m_employee', $row['employee_id'])->first();
    //         if(!$if_redundant){
    //             new M_employee([
    //                 'id_m_employee' => M_employee::maxId(),
    //                 'nip_m_employee' => $row['employee_id'],
    //                 'nipk_m_employee' => $row['id_pengenal'],
    //                 'nm_m_employee' => $row['formal_name'],
    //                 'status_m_employee' => $row['employee_status'],
    //                 'group_m_employee' => $row['employee_group'],
    //                 'cost_center_m_employee' => $row['employee_cost_center'],
    //                 'position_m_employee' => $row['position_description'],
    //                 'business_unit_m_employee' => $row['business_unit'],
    //                 'department_m_employee' => $row['department_description'],
    //                 'level_3_m_employee' => $row['hms_org_lvl_3_descr'],
    //                 'level_4_m_employee' => $row['hms_org_lvl_4_descr'],
    //                 'level_5_m_employee' => $row['hms_org_lvl_5_descr'],
    //                 'basetown_m_employee' => $row['basetown_location'],
    //                 'gender_m_employee' => $row['gender'],
    //                 'age_classification_m_employee' => $row['age_classification_in_2015'],
    //                 'remarks_m_employee' => $row['remarks'],
    //                 'year_m_employee' => date('Y'),
    //             ]);
    //         }
    //     }
    // }

    // ===================================================



    use Importable;



    public function model(array $row)
    {
        $keys = array_keys($row);
        // excel heading validation
        if(
                $keys[0] == 'employee_id'
            and $keys[1] == 'id_pengenal'
            and $keys[2] == 'formal_name'
            and $keys[3] == 'employee_status'
            and $keys[4] == 'employee_group'
            and $keys[5] == 'employee_cost_center'
            and $keys[6] == 'position_description'
            and $keys[7] == 'business_unit'
            and $keys[8] == 'department_description'
            and $keys[9] == 'hms_org_lvl_3_descr'
            and $keys[10] == 'hms_org_lvl_4_descr'
            and $keys[11] == 'hms_org_lvl_5_descr'
            and $keys[12] == 'basetown_location'
            and $keys[13] == 'gender'
            and $keys[14] == 'age_classification_in_2015'
            and $keys[15] == 'remarks'
        ){

            @ini_set('max_execution_time', 0);
            // EXCEPTION PADA BARIS EXCEL PALING AKHIR TIDAK DILAKUKAN PROSES BACA OLEH LIBRARY KARENA BERNILAI EMPTY
            if(!end($row)){



              //  \DB::enablequerylog();
                $if_exists = M_employee::where('year_m_employee', date('Y'))->where('nip_m_employee', $row['employee_id'])->first();




                // JIKA BARIS MEMPUNYAI NILAI EMPLOYEE_ID TIDAK NULL, DAN NILAI DARI $if_exists = null
                if($row and $if_exists==null and $row['employee_id']){

                    return new M_employee([
                        // 'id_m_employee' => M_employee::maxId(),
                        'nip_m_employee' => $row['employee_id'],
                        'nipk_m_employee' => $row['id_pengenal'],
                        'nm_m_employee' => $row['formal_name'],
                        'status_m_employee' => $row['employee_status'],
                        'group_m_employee' => $row['employee_group'],
                        'cost_center_m_employee' => $row['employee_cost_center'],
                        'position_m_employee' => $row['position_description'],
                        'business_unit_m_employee' => $row['business_unit'],
                        'department_m_employee' => $row['department_description'],
                        'level_3_m_employee' => $row['hms_org_lvl_3_descr'],
                        'level_4_m_employee' => $row['hms_org_lvl_4_descr'],
                        'level_5_m_employee' => $row['hms_org_lvl_5_descr'],
                        'basetown_m_employee' => $row['basetown_location'],
                        'gender_m_employee' => $row['gender'],
                        'age_classification_m_employee' => $row['age_classification_in_2015'],
                        'remarks_m_employee' => $row['remarks'],
                        'year_m_employee' => date('Y'),
                        'id_m_project' => $this->id_m_project,
                    ]);

                }else if($row and $if_exists!=null and $row['employee_id']){
                    try{
                        M_employee::where('nip_m_employee', $row['employee_id'])->update([
                            'nipk_m_employee' => $row['id_pengenal'],
                            'nm_m_employee' => $row['formal_name'],
                            'status_m_employee' => $row['employee_status'],
                            'group_m_employee' => $row['employee_group'],
                            'cost_center_m_employee' => $row['employee_cost_center'],
                            'position_m_employee' => $row['position_description'],
                            'business_unit_m_employee' => $row['business_unit'],
                            'department_m_employee' => $row['department_description'],
                            'level_3_m_employee' => $row['hms_org_lvl_3_descr'],
                            'level_4_m_employee' => $row['hms_org_lvl_4_descr'],
                            'level_5_m_employee' => $row['hms_org_lvl_5_descr'],
                            'basetown_m_employee' => $row['basetown_location'],
                            'gender_m_employee' => $row['gender'],
                            'age_classification_m_employee' => $row['age_classification_in_2015'],
                            'remarks_m_employee' => $row['remarks'],
                            'year_m_employee' => date('Y'),
                            'id_m_project' => $this->id_m_project,
                        ]);
                    }catch(\Exception $e){
                        return false;
                    }
                }else{

                }

            }

        }else{
            $error = ['format' => 'invalid heading format'];
            $failures[] = new Failure(1, 'format', $error,$row);
            throw new \Maatwebsite\Excel\Validators\ValidationException(\Illuminate\Validation\ValidationException::withMessages($error),$failures);
        }
    }

    // public function headingRow(): int
    // {
    //     return 1;
    // }

    public function batchSize(): int
    {
        return 1000;
    }

    // public function chunkSize(): int
    // {
    //     return 1000;
    // }

    public function uniqueBy()
    {
        return 'nip_m_employee';
    }
}
