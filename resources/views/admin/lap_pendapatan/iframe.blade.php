<iframe src="{{route('admin.lap_pendapatan.pdf_lap_pendapatan', ['bulan' => request()->get('bulan'),'tahun' => request()->get('tahun')])}}"
    height="700"
    width="100%">
</iframe>
