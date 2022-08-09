{{-- @section('content') --}}
<!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ $page_title.' : '.$t_sds->email_t_sds }}</h4>
                </div>
                <input type="hidden" id="id_t_sds" name="id_t_sds" value="{{$t_sds->id_t_sds}}">
                <hr class="my-0" />
                <div class="card-datatable">
                    <table id="dt_info" class="table-striped table-hover table table-bordered">
                        <thead>
                            <tr>
                                <th>Filled Date</th>
                                <th>Age</th>
                                <th>Work Time (year)</th>
                                <th>Education</th>
                                <th>Working Area</th>
                                <th>Position</th>
                                <th>Working Status</th>
                                <th>Marital Status</th>
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
        var id_t_sds=$('#id_t_sds').val();
        // console.log(id_t_sds_det);
        $('#dt_info').DataTable({
            processing: true,
            scrollX: true,
            serverside: true,
            pageLength: 20,
            ajax: {
                url: '{{ route('admin.report.form_sds.dt_info',['menu'=>request()->get('menu')]) }}',
                data: {
                    id_t_sds:id_t_sds
                },
                method: 'POST'
            }
        });
    });
</script>
{{-- @endsection --}}
