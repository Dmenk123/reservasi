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

class Import_branch_data_collection implements ToCollection,WithStartRow
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


        foreach ($rows as $row)
        {
            $if_exists = M_branch_company::where('nm_m_branch_company', $row['12'])->where('business_unit', $row['7'])->first();
            if($row and $if_exists==null and $row[12]){
                M_branch_company::create([
                    'id_m_branch_company' => M_branch_company::maxId(),
                    'nm_m_branch_company' => $row[12],
                    'basetown_city' => $row[15],
                    'address_m_branch_company' => $row[21],
                    'business_unit' => $row[7],


                ]);

            }else  if($row and $if_exists!=null and $row[0]){
                try{
                    // M_branch_company::where('nm_m_branch_company', $row[12])->where('business_unit', $row[7])->update([
                    //     'nm_m_branch_company' => $row[12],
                    //     'basetown_city' => $row[15],
                    //     'address_m_branch_company' => $row[21],
                    //     'business_unit' => $row[7],

                    // ]);

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

    // public function uniqueBy()
    // {
    //     return 'nm_m_branch_company';
    // }

}
