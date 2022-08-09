<table>
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>Email</th>
            <th>Registration No.</th>
            <th>Lokasi Pemeriksaan</th>
            <th>Name</th>
            <th>NIK / Employee ID</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Position</th>
            <th>Division</th>
            <th>Location</th>
            <th>Examined Date</th>
            <th>Examiner Doctor</th>

            <th>Apakah ada keluhan saat ini?</th>
            @foreach ($m_keluhan as $item)
            <th>{{$item->nm_m_keluhan}}</th>
            @endforeach

            <th>Apakah ada riwayat penyakit?</th>
            @foreach ($m_riwayat_penyakit as $item)
            <th>{{$item->m_jenis_penyakit->nm_m_jenis_penyakit.'['.$item->nm_m_riwayat_penyakit.']'}}</th>
            @endforeach

            <th>Apakah ada riwayat penyakit keluarga?</th>
            @foreach ($m_penyakit_keluarga as $item)
            <th>{{$item->nm_m_penyakit_keluarga}}</th>
            @endforeach

            <th>Apakah ada riwayat kebiasaan hidup?</th>
            @foreach ($m_kebiasaan_hidup as $item)
            <th>{{$item->nm_m_kebiasaan_hidup}}</th>
            @endforeach


            <th>Apakah ada riwayat konsumsi obat teratur?</th>
            @foreach ($m_konsumsi_obat as $item)
            <th>{{$item->nm_m_konsumsi_obat}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>


        @foreach($t_riwayat_kesehatan as $item)


        @php
            if ($item->id_m_lokasi_pemeriksaan){

                $lokasi=\App\Models\M_lokasi_pemeriksaan::where('id_m_lokasi_pemeriksaan',$item->id_m_lokasi_pemeriksaan)->first();
                $lokasi='';
            }
            else if ($item->id_m_branch){

                $lokasi=\App\Models\M_branch::where('id_m_branch',$item->id_m_branch)->first();
                $lokasi=$lokasi->nm_m_branch;
            }else {

                $lokasi='';
            }


        @endphp

        <tr>
            <td>{{ $item->created_at}}</td>
            <td>{{ $item->email_t_riwayat_kesehatan }}</td>
            <td>{{ $item->no_reg_t_riwayat_kesehatan }}</td>
            {{-- <td>{{ $item->m_lokasi_pemeriksaan->nm_m_lokasi_pemeriksaan }}</td> --}}
            <td>{{ $lokasi }}</td>
            <td>{{ $item->nama_t_riwayat_kesehatan }}</td>
            <td>{{ $item->nik_t_riwayat_kesehatan }}</td>
            <td>{{ $item->umur_t_riwayat_kesehatan }}</td>
            <td>{{
                (
                $item->jk_t_riwayat_kesehatan==1?'MALE':'FEMALE'
                )
                }}</td>
            <td>{{ $item->jabatan_t_riwayat_kesehatan }}</td>
            <td>{{ $item->divisi_t_riwayat_kesehatan }}</td>
            <td>{{ $item->lokasi_t_riwayat_kesehatan }}</td>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',
                $item->tanggal_periksa_t_riwayat_kesehatan)->format('d-m-Y') }}</td>
            <td>{{ $item->dokter_pemeriksa_t_riwayat_kesehatan }}</td>

            @php
                try{
                    $val=$t_riwayat_kesehatan_det
                        ->where('id_m_keluhan',$m_keluhan->first()->id_m_keluhan)
                        ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                        ->first()
                        ->ans_t_riwayat_kesehatan_det;
                }
                catch(Exception $ex){
                    $val=99;
                }
            @endphp

            <td>{{$val==99?'Tidak ada keluhan saat ini':'Ada keluhan saat ini'}}</td>

            @foreach ($m_keluhan as $item2)
                @php
                    // dd($item2);
                    // if(isset($val)){unset($val);}

                    try{
                        $val=$t_riwayat_kesehatan_det
                            ->where('id_m_keluhan',$item2->id_m_keluhan)
                            ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                            ->first()
                            ->ans_t_riwayat_kesehatan_det;
                    }
                    catch(Exception $ex){
                        $val="TIDAK";
                    }
                @endphp

                <td>{{(($val==1?'YA':(
                    $val==2?'TIDAK':(
                        $val
                ))))}}</td>
            @endforeach


            @php
                try{
                    $val=$t_riwayat_kesehatan_det
                        ->where('id_m_riwayat_penyakit',$m_riwayat_penyakit->first()->id_m_riwayat_penyakit)
                        ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                        ->first()
                        ->ans_t_riwayat_kesehatan_det;
                }
                catch(Exception $ex){
                    $val=99;
                }
            @endphp

            <td>{{$val==99?'Tidak ada riwayat penyakit':'Ada riwayat penyakit'}}</td>


            @foreach ($m_riwayat_penyakit as $item2)
                @php
                    // dd($item2);
                    // if(isset($val)){unset($val);}
                    try{
                        $val=$t_riwayat_kesehatan_det
                            ->where('id_m_riwayat_penyakit',$item2->id_m_riwayat_penyakit)
                            ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                            ->first()
                            ->ans_t_riwayat_kesehatan_det;
                    }
                    catch(Exception $ex){
                        $val="TIDAK";
                    }
                @endphp
                <td>{{(($val==1?'YA':(
                    $val==2?'TIDAK':(
                        $val
                ))))}}</td>
            @endforeach

            @php
                try{
                    $val=$t_riwayat_kesehatan_det
                        ->where('id_m_penyakit_keluarga',$m_penyakit_keluarga->first()->id_m_penyakit_keluarga)
                        ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                        ->first()
                        ->ans_t_riwayat_kesehatan_det;
                }
                catch(Exception $ex){
                    $val=99;
                }
            @endphp

            <td>{{$val==99?'Tidak ada riwayat penyakit keluarga':'Ada riwayat penyakit keluarga'}}</td>

            @foreach ($m_penyakit_keluarga as $item2)
                @php
                    // dd($item2);
                    // if(isset($val)){unset($val);}
                    try{
                        $val=$t_riwayat_kesehatan_det
                            ->where('id_m_penyakit_keluarga',$item2->id_m_penyakit_keluarga)
                            ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                            ->first()
                            ->ans_t_riwayat_kesehatan_det;
                    }
                    catch(Exception $ex){
                        $val="TIDAK";
                    }
                @endphp
                <td>{{(($val==1?'YA':(
                    $val==2?'TIDAK':(
                        $val
                ))))}}</td>
            @endforeach

            @php
                try{
                    $val=$t_riwayat_kesehatan_det
                        ->where('id_m_kebiasaan_hidup',$m_kebiasaan_hidup->first()->id_m_kebiasaan_hidup)
                        ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                        ->first()
                        ->ans_t_riwayat_kesehatan_det;
                }
                catch(Exception $ex){
                    $val=99;
                }
            @endphp

            <td>{{$val==99?'Tidak ada riwayat kebiasaan hidup':'Ada riwayat kebiasaan hidup'}}</td>

            @foreach ($m_kebiasaan_hidup as $item2)
                @php
                    // dd($item2);
                    // if(isset($val)){unset($val);}
                    try{
                        $val=$t_riwayat_kesehatan_det
                            ->where('id_m_kebiasaan_hidup',$item2->id_m_kebiasaan_hidup)
                            ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                            ->first()
                            ->ans_t_riwayat_kesehatan_det;
                    }
                    catch(Exception $ex){
                        $val="TIDAK";
                    }
                @endphp
                <td>{{(($val==1?'YA':(
                    $val==2?'TIDAK':(
                        $val
                ))))}}</td>
            @endforeach




            @php
                try{
                    $val=$t_riwayat_kesehatan_det
                        ->where('id_m_konsumsi_obat',$m_konsumsi_obat->first()->id_m_konsumsi_obat)
                        ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                        ->first()
                        ->ans_t_riwayat_kesehatan_det;
                }
                catch(Exception $ex){
                    $val=99;
                }
            @endphp

            <td>{{$val==99?'Tidak ada riwayat konsumsi obat teratur':'Ada riwayat konsumsi obat teratur'}}</td>

            @foreach ($m_konsumsi_obat as $item2)
                @php
                    // dd($item2);
                    // if(isset($val)){unset($val);}
                    try{
                        $val=$t_riwayat_kesehatan_det
                            ->where('id_m_konsumsi_obat',$item2->id_m_konsumsi_obat)
                            ->where('id_t_riwayat_kesehatan',$item->id_t_riwayat_kesehatan)
                            ->first()
                            ->ans_t_riwayat_kesehatan_det;
                    }
                    catch(Exception $ex){
                        $val="TIDAK";
                    }
                @endphp
                <td>{{(($val==1?'YA':(
                    $val==2?'TIDAK':(
                        $val
                ))))}}</td>
            @endforeach
        </tr>

        @endforeach
    </tbody>
</table>
