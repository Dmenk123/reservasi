


<table>
    <thead>
        <tr>
            <th>Timestamp</th>
            {{-- <th>Tanggal Pengisian</th> --}}
            @foreach ($m_sds->where('is_info',1)->sortBy('order_m_sds') as $item)
            <th>{{$item->nm_m_sds}}</th>
            @endforeach
            @foreach ($m_sds->where('is_info',0)->sortBy('id_m_sds') as $item)
            <th>{{$item->nm_m_sds}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($t_sds as $item)


        @php
            if ($item->id_m_lokasi_pemeriksaan){

                $lokasi='';
            }else if ($item->id_m_branch){


                $q_lokasi=\App\Models\M_branch::where('id_m_branch',$item->id_m_branch)->first();
                $lokasi=$q_lokasi->nm_mm_branch;
            }else {

                $lokasi='';
            }
        @endphp
        <tr>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->email_t_sds }}</td>
            {{-- <td>{{ $item->m_lokasi_pemeriksaan->nm_m_lokasi_pemeriksaan }}</td> --}}
            <td>{{ $lokasi }}</td>
            <td>{{ $item->tanggal_t_sds }}</td>
            <td>{{ $item->nama_t_sds }}</td>
            <td>{{ $item->employee_id_t_sds }}</td>
            <td>{{ $item->usia_t_sds }}</td>
            <td>{{ $item->masa_kerja_t_sds }}</td>
            <td>{{ $item->pendidikan_t_sds }}</td>
            <td>{{ $item->wilayah_kerja_t_sds }}</td>
            <td>{{ $item->jabatan_t_sds }}</td>
            <td>{{ $item->status_pekerjaan_t_sds }}</td>
            <td>{{
                (
                $item->status_pernikahan_t_sds==0?'SINGLE':
                (
                $item->status_pernikahan_t_sds==1?'MENIKAH':
                (
                $item->status_pernikahan_t_sds==2?'DUDA':
                'JANDA'
                )
                )
                )
                }}</td>

            @foreach ($t_sds_det->where('id_t_sds',$item->id_t_sds) as $item2)
            <td>{{ $item2->ans_t_sds_det }}</td>
            @endforeach
        </tr>

        @endforeach
    </tbody>
</table>
