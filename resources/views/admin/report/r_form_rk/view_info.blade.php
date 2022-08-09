{{-- @section('content') --}}
<!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ $page_title.' : '.$t_riwayat_kesehatan->nama_t_riwayat_kesehatan }}</h4>
                </div>
                <input type="hidden" id="id_t_riwayat_kesehatan" name="id_t_riwayat_kesehatan" value="{{$t_riwayat_kesehatan->id_t_riwayat_kesehatan}}">
                <hr class="my-0" />
                <div class="card-datatable">
                    <table id="dt_info" class="table-striped table-hover table table-bordered">
                        <thead>
                            <tr>
                                <th>Filled Date</th>
                                <th>Email</th>
                                <th>Examination Location</th>
                                <th>NIK / Employee ID</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Position</th>
                                <th>Division</th>
                                <th>Working Location</th>
                                <th>Examined Date</th>
                                <th>Examiner Doctor</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                {{-- <div class="card-footer">
                    <a class="btn btn-warning float-right"
                        href="{{route('admin.report.form_sds.index',['menu'=>request()->get('menu')])}}">Return</a>
                </div> --}}
            </div>
        </div>
    </div>
</section>
<!--/ Advanced Search -->
<div></div>
    @include('admin.layout.modal_edit')
{{-- @endsection --}}

{{-- @section('js') --}}
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $(document).ready(function() {
        var id_t_riwayat_kesehatan=$('#id_t_riwayat_kesehatan').val();
        // console.log(id_t_riwayat_kesehatan_det);
        $('#dt_info').DataTable({
            processing: true,
            scrollX: true,
            serverside: true,
            pageLength: 20,
            ajax: {
                url: '{{ route('admin.report.form_rk.dt_info',['menu'=>request()->get('menu')]) }}',
                data: {
                    id_t_riwayat_kesehatan:id_t_riwayat_kesehatan
                },
                method: 'POST'
            }
        });
    });
</script>
{{-- @endsection --}}
