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
    </div>

    <div class="sub-note">
       status : Belum Dibayar
    </div>
</div>
