<html>
    <head>
        {{-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" /> --}}
        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }
            .container{
                background: #ffffff;
            }
        </style>
    </head>
    <body>

    <div align="center">
        <img src="{{asset('assets/images/logo_pramita.png')}}" height="140" alt="">
        <h3 align="center" class="text-center">
            <u>Silahkan Pindai Kode QR ini untuk Cek In :</u><br>
            <em>Please Scan this QR Code for Check In at :</em>
            <br>
        </h3>

        <div class="text-center" style="text-align: center">
            <img src="data:image/png;base64, {!! $qrcode !!}">
        </div>


        <div class="row">
            <div class="col-12">
                <h3 class="text-success">{{($row->id_m_branch_company) ? $row->m_branch_company->m_company->nm_m_company.' - '.$row->m_branch_company->nm_m_branch_company : ''}}</h3>
                <h3 class="text-success">{{($row->date_start_mcu and $row->date_finish_mcu) ? \Carbon\Carbon::createFromFormat('Y-m-d', $row->date_start_mcu)->isoFormat('D MMMM YYYY').' - '.\Carbon\Carbon::createFromFormat('Y-m-d', $row->date_finish_mcu)->isoFormat('D MMMM YYYY') : ''}}</h3>
                <br>
                <br>
                <h4>
                    <u>Cabang Pelaksana :</u>
                    <br>
                    <em>Field Executive :</em>
                    <br>
                    <br>
                    {{-- <span class="text-success">{{($row->id_m_branch) ? $row->m_branch->entity->nm_m_entity : ''}}</span><br> --}}

                    @php
                        if ($row->id_m_branch_pelaksana){

                            $pelaksana=\App\Models\M_branch::where('id_m_branch',$row->id_m_branch_pelaksana)->first();
                            $pelaksana_name=$pelaksana->nm_m_branch;
                        }else {

                            $pelaksana_name='';
                        }
                    @endphp


                    <span class="text-success">{{($row->id_m_branch_pelaksana) ? $pelaksana_name : ''}}</span>
                </h4>
            </div>
        </div>
    </div>





    </body>
</html>

