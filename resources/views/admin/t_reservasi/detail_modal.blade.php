<div class="col-12">
    <div class="card card-transaction">
        <div class="card-body">

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Nama</h6>
                        <small style="font-style: italic;">Nama Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->nm_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Email</h6>
                        <small style="font-style: italic;">Email Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->email_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Kode</h6>
                        <small style="font-style: italic;">Kode Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->kode_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Telp</h6>
                        <small style="font-style: italic;">Telp Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->telp_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Proses</h6>
                        <small style="font-style: italic;">Nama Proses</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->m_proses->nm_m_proses ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Hari / Tanggal</h6>
                        <small style="font-style: italic;">Hari Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->hari_t_reservasi.' / '.\Carbon\Carbon::parse($old->tanggal_t_reservasi)->format('d-m-Y') ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Jam</h6>
                        <small style="font-style: italic;">Jam Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->jam_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Jenis</h6>
                        <small style="font-style: italic;">Jenis Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->jenis_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Metode</h6>
                        <small style="font-style: italic;">Metode Pembayaran Reservasi</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->metode_pembayaran_t_reservasi ?? '-'}}</div>
            </div>

            <div class="transaction-item">
                <div class="d-flex flex-row">
                    <div class="transaction-info">
                        <h6 class="transaction-title">Kode</h6>
                        <small style="font-style: italic;">Kode Payment (Jika payment gateway)</small>
                    </div>
                </div>
                <div class="fw-bolder text-primary">{{$old->kode_payment_t_reservasi ?? '-'}}</div>
            </div>

        </div>
    </div>
</div>
