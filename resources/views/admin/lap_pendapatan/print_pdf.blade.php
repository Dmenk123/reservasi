@php
    $hari_array = array("MINGGU","SENIN","SELASA","RABU","KAMIS","JUMAT","SABTU");
    $bulan_array  = array_bulan_indo();
    $tgl_hari_ini = \Carbon\Carbon::now()->format('d-m-Y');
    $waktu_hari_ini = \Carbon\Carbon::now()->format('H:i:s');

    function currency_formatting($number) {
        return ((int)$number > 0) ? '<div style="text-align:right;">'.number_format($number,0,',','.').'</div>' : '<div style="text-align:right;">0</div>';
    }

    $total_penerimaan = 0;
@endphp

<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    table th {
        text-align: center;
    }

    table tr td{
        padding: 3px;
        font-size: 12px;
        color: #000000;
        font-weight: 600;
    }

    table.grid tr th, table.grid tr td{
        padding: 1px 4px;
        font-size: 12px;
        border: 1px solid #000000;
    }

    /* @media screen and (max-width: 767px) {

        .table-responsives {
            zoom: 0.5;
            -moz-transform: scale(0.5);
        }
    } */

</style>

<div class="report-page">


    <table width="100%">
        <tr>
            <td><img src="{{asset('assets/fo/img/logo-identity.png')}}" height="50"/></td>
            <td><h4 style="font-weight:600;color:black;">Laporan Pendapatan
            @if(isset($tgl_awal) and isset($tgl_akhir))
                <br>Periode {{$bulan_array[(int)\Carbon\Carbon::parse($tgl_awal)->format('m')] .' '. (int)\Carbon\Carbon::parse($tgl_akhir)->format('Y')}}
            @endif
            </h4></td>
            <td align="right" width="20%" style="font-weight:600;color:black;">Dicetak pada : {{\Carbon\Carbon::parse(date('Y-m-d H:i:s'))->format('j M Y H:i')}}</td>
        </tr>
    </table>

    <table width="100%" cellspacing="0" cellpadding="0" class="grid">
        <thead>
            <tr>
                <th width="9%" rowspan="2">Tgl Bayar</th>
                <th colspan="6">Data Reservasi</th>
                <th rowspan="2">Konfirmasi</th>
                <th rowspan="2">Nominal</th>
            </tr>
            <tr>
                <th>Nama Reservasi</th>
                <th>HP</th>
                <th>Email</th>
                <th>Tgl Reservasi</th>
                <th>Hari</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php
                dd($datanya);
            @endphp --}}
            @foreach ($datanya as $key => $data)
                @php
                    $pembayaran = $data->t_pembayaran;
                    $reservasi = $data->t_pembayaran->t_reservasi;
                    $total_penerimaan += $data->nominal_t_pembayaran_det;
                @endphp
                <tr>
                    <td align="center">{{\Carbon\Carbon::parse($data->tgl_t_pembayaran_det)->format('d-m-Y')}}</td>
                    <td align="center">{{$reservasi->nm_t_reservasi ?? ''}}</td>
                    <td align="center">{{$reservasi->telp_t_reservasi ?? ''}}</td>
                    <td align="center">{{$reservasi->email_reservasi ?? ''}}</td>
                    <td align="center">{{\Carbon\Carbon::parse($reservasi->tanggal_t_reservasi)->format('d-m-Y')}}</td>
                    <td align="center">{{$reservasi->hari_t_reservasi ?? ''}}</td>
                    <td align="center">{{$reservasi->jam_t_reservasi ?? ''}}</td>
                    <td align="center">{{$data->kode_konfirmasi ?? ''}}</td>
                    <td align="center">{!!currency_formatting($data->nominal_t_pembayaran_det)!!}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8" style="text-align: center;"><i>Total Pendapatan Periode {{$bulan_array[(int)\Carbon\Carbon::parse($tgl_awal)->format('m')] .' '. (int)\Carbon\Carbon::parse($tgl_akhir)->format('Y')}} </i></td>
                <td align="center" style="font-weight: 800;">{!!currency_formatting($total_penerimaan)!!}</td>
            </tr>
        </tbody>
    </table>
</div>



