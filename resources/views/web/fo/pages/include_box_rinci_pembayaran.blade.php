<div class="card positive">
    <div class="main-content">
      <div class="status-label">Tagihan</div>
      <div class="card-title">Rincian</div>

      <dl class="info-listing clearfix">
        <dt class="ion-ios-pricetag" style="margin: 0px!important">{{ $reservasi->jenis_t_reservasi == 'cash' ? 'Paket Lunas' : 'Paket Ngecup'  }}</dt>
        <dd>{{number_format($harga->nominal_m_harga,0,',','.')}}</dd>
        {{-- <dt class="ion-ios-pricetag" style="margin: 0px!important">Status</dt>
        <dd>Stable</dd> --}}
      </dl>

      @if ($reservasi->jenis_t_reservasi != 'cash')
        @php
            $cek_bayar = \App\Models\T_pembayaran::with(['t_pembayaran_det', 't_reservasi'])->where('id_t_reservasi', $reservasi->id_t_reservasi)->first();
        @endphp
        @if ($cek_bayar && $cek_bayar->t_pembayaran_det->isNotEmpty())
            <hr>
            <div class="card-title">Pembayaran Sukses</div>
            @foreach ($cek_bayar->t_pembayaran_det as $key => $item)
                <dl class="info-listing clearfix">
                    <dt class="ion-ios-pricetag" style="margin: 0px!important">Angsuran ke-{{$key+1}}, {{\Carbon\Carbon::parse($item->tgl_t_pembayaran_det)->format('d-m-Y')}}</dt>
                    <dd>{{number_format($item->nominal_t_pembayaran_det,0,',','.')}}</dd>
                </dl>
            @endforeach
        @endif
      @endif

    </div>

    <div class="sub-note">
       status : {{($reservasi->m_proses->id_m_proses != \App\Models\M_proses::ID_M_PROSES_TRANSAKSI_SELESAI) ? 'Belum Dibayar': $reservasi->m_proses->nm_m_proses }}
    </div>
</div>

