<div class="col-12">
    <div class="card card-transaction">
        <div class="card-body">
            <h4 class="card-title">Data Pembayaran</h4>
            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Nama</h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->t_reservasi->nm_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">HP</h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->t_reservasi->telp_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Email</h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->t_reservasi->email_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Kode</h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->t_reservasi->kode_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Nilai Pembayaran</h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{($old->nilai_t_pembayaran) ? number_format($old->nilai_t_pembayaran,0,',','.') : '0'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Jenis Pembayaran</h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->jenis_t_pembayaran ?? '-'}}</div>
            </div>

            @if ($old->jenis_t_pembayaran != 'cash')
            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Cicilan Ke </h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->cicilan_ke_t_pembayaran ?? '-'}}</div>
            </div>
            @endif

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Total Pembayaran </h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{($old->nominal_total_t_pembayaran) ? number_format($old->nominal_total_t_pembayaran,0,',','.') : '-'}}</div>
            </div>

            @if ($old->tgl_pelunasan_t_pembayaran)
            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Tgl Pelunasan</h6>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{\Carbon\Carbon::parse($old->tgl_pelunasan_t_pembayaran)->format('d-m-Y') ?? '-'}}</div>
            </div>
            @endif
        </div>
    </div>

    <div class="card card-transaction">
        <div class="card-body">
            <h4 class="card-title">Detail Pembayaran</h4>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Konfirmasi</th>
                                    <th>Nominal</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($old->t_pembayaran_det as $key => $val)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($val->tgl_t_pembayaran_det)->format('d-m-Y')}}</td>
                                    <td>{{$val->kode_konfirmasi}}</td>
                                    <td style="text-align: right;">{{number_format($val->nominal_t_pembayaran_det,0,',','.')}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary" onclick="viewBuktiPembayaran({{$val->id_t_pembayaran_det}})">View Bukti</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
