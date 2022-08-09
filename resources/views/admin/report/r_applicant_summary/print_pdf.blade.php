<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    #datatable{
        outline: none;
        padding: 0;
    }

    #datatable tr td, #datatable tr th{
        border: 1px solid #000;
        padding: 3px 5px;
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        vertical-align: top;
    }
</style>

<table width="100%">
    <tr>
        <td><img src="{{asset('assets/images/logo_pramita.png')}}" height="50"/></td>
        <td align="center"><h4>Applicant Summary Report
        @if(request()->filled('id_m_profession'))
        <br>
        @php
            $profession_name = \App\Models\M_profession::where('id_m_profession', request()->get('id_m_profession'))->firstOrFail()->nm_m_profession;
            echo strtoupper($profession_name);
        @endphp
        @else
        <br>All Positions
        @endif
         <br> 
        @if(request()->filled('id_m_entity'))
        @php
            $entity_name = \App\Models\M_entity::where('id_m_entity', request()->get('id_m_entity'))->firstOrFail()->nm_m_entity;
            echo strtoupper($entity_name);
        @endphp
        @else
        All Entities
        @endif
         - 
        @if(request()->filled('id_m_branch'))
        @php
            $branch_name = \App\Models\M_branch::where('id_m_branch', request()->get('id_m_branch'))->firstOrFail()->nm_m_branch;
            echo strtoupper($branch_name);
        @endphp
        @else
        All Branches
        @endif
        
        
        </h4></td>
        <td align="right"><span style="font-size:12px;">Printed at : {{\Carbon\Carbon::parse(date('Y-m-d H:i:s'))->format('j M Y H:i:s')}} WIB</span></td>
    </tr>
</table>

<table width="100%" id="datatable" cellpadding="0" cellspacing="0" class="datatable table-sm mt-2 table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Entity</th>
            <th>Branch</th>
            <th>Position</th>
            <th>Min Requirement</th>
            <th>Start & End Date</th>
            <th>Total Applicant</th>
            <th>Modified at</th>
        </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
    @endphp
     @foreach ($table as $item)
         <tr>
             <td align="center">{{$i++}}.</td>
             <td>{{ $item->branch->entity->nm_m_entity }}</td>
             <td>{{ $item->branch->nm_m_branch }}</td>
             <td>{{ $item->profession->nm_m_profession }}</td>
             <td>{{ $item->education_level->nm_m_education_level }}</td>
             <td>{{ ($item->date_start_vacancy) ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->date_start_vacancy)->format('d-m-Y').' to '.\Carbon\Carbon::createFromFormat('Y-m-d', $item->date_end_vacancy)->format('d-m-Y') : '-' }}</td>
             <td align="center">{{ number_format($item->applicant_count, 0, ',', '.') }}</td>
             <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->updated_at)->format('d-m-Y H:i:s') }}</td>
        </tr>
     @endforeach
    </tbody>
</table>