@extends('admin.layout.index')




@section('content')
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ $page_title }}</h4>
                        <a href="#"
                            class="btn btn-warning float-right btn-disabled"><i>{{ $old->nm_m_workflow_category }}</i></a>
                    </div>

                    <hr class="my-0" />
                    <div class="card-datatable">
                        <form class="form-horizontal" id="form" method="post">

                            <input type="hidden" class="form-control" value="{{ $old->id_m_workflow_category }}"
                                name="id_m_workflow_category" id="id_m_workflow_category">
                            <table id="datatable" class="table-striped table-hover table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Process</th>
                                        <th>Check</th>
                                        <th>Sequence</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $x =1; @endphp

                                    @php

                                        // $table_file = \App\Models\M_produk_det::with('m_jns_pengerjaan','m_material_gigi')->where('id_input_order', \Request::get('id'))->where('id_m_jns_file','<>','1')->with('jenisfile')->orderByDesc('id_t_file')->get();
                                        // $datas = [];
                                        $table_file = \App\Models\M_process::where('active_m_process', 'ACTIVE')
                                            ->orderBy('id_m_process', 'ASC')
                                            ->get();
                                        $i = 1;
                                    @endphp

                                    @foreach ($table_file as $list_file)

                                        @php

                                            //\DB::enablequerylog();
                                            $cek_isi = \App\Models\M_workflow::where('id_m_workflow_category', request('id_m_workflow_category'))
                                                ->where('id_m_process', $list_file->id_m_process)
                                                ->first();

                                            // dd(\DB::getquerylog());

                                        @endphp
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $list_file->nm_m_process }} - {{ $list_file->id_m_process }}</td>
                                            <td>
                                                <div class="col-sm-8">
                                                    {{-- <input type="hidden" value="{{$list_file->id_m_produk_det}}" name="rowget[]" /> --}}
                                                    <input type="checkbox" value="{{ $list_file->id_m_process }}"
                                                        name="id_m_process[]" id="id_m_process[]"
                                                        {{ $cek_isi ? 'checked' : '' }} />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-4">
                                                    <input type="text" style="text-align: right" class="form-control"
                                                        name="sequence_m_workflow_{{ $list_file->id_m_process }}"
                                                        id="sequence_m_workflow_{{ $list_file->id_m_process }}"
                                                        value="{{ $cek_isi ? $cek_isi->sequence_m_workflow : '' }}">
                                                </div>

                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <a class="btn btn-default float-right"
                                    href="{{ route('admin.m_workflow_category.index',['menu'=>request()->get('menu')]) }}">Batal</a>
                                <button type="submit" id="submitform" class="btn btn-info"><span>Simpan</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Advanced Search -->
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#form").submit(function() {
                $(".text-danger").remove();
                event.preventDefault();
                var data = new FormData($('#form')[0]);
                $("#submitform").attr('disabled', true);
                $("#submitform span").text('Mohon tunggu...');

                $.ajax({
                    url: "{{ route('admin.m_workflow_category.workflow_update',['menu'=>request()->get('menu')]) }}",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {

                            if (data.status == true) {
                                $("#submitform").removeAttr('disabled');
                                $("#submitform span").text('Simpan');
                                $("form").each(function() {
                                    this.reset()
                                });
                                swal.fire({
                                    title: "Berhasil Menyimpan Data !",
                                    text: "Berhasil Menyimpan Data !",
                                    icon: "success"
                                }).then(function() {
                                    location.href = data.redirect;
                                });
                            } else {
                                swal.fire("Telah terjadi kesalahan pada sistem", data.message,
                                    "error");
                            }

                        } else {
                            swal.fire("Terjadi kesalahan input!", "cek kembali inputan anda",
                                "warning");
                            $("#submitform").removeAttr('disabled');
                            $("#submitform span").text('Simpan');
                            $.each(data.error, function(key, value) {
                                var element = $("#" + key);
                                element.closest("div.form-control")
                                    .removeClass("text-danger")
                                    .addClass(value.length > 0 ? "text-danger" : "")
                                    .find("#error_" + key).remove();
                                element.after("<div id=error_" + key +
                                    " class=text-danger>" + value + "</div>");
                            });
                        }
                    },
                    error: function(data) {
                        swal.fire("Telah terjadi kesalahan pada sistem", data.message, "error");
                    }
                });
            });
        });
    </script>
@endsection
