@extends('template_bo.index')




@section('content')

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$page_title ? $page_title : 'Page Name'}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$page_title ? $page_title : 'Page Name'}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$page_title ? $page_title : 'Page Name'}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form class="form-horizontal" id="form" method="post">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="nm_material" class="col-sm-2 col-form-label">Workflow Category</label>
                    <div class="col-sm-10">
                      <input type="hidden"  class="form-control" value="{{$old->id_m_workflow_category}}" name="id_m_workflow_category" id="id_m_workflow_category">
                      <input type="text"  class="form-control" readonly name="nm_m_workflow_category" value="{{$old->nm_m_workflow_category}}" id="nm_m_workflow_category">
                    </div>
                  </div>

                  {{-- <div class="form-group row">
                    <label for="id_m_color_merk" class="col-sm-2 col-form-label">Color Merk</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_m_color_merk" id="id_m_color_merk">
                        <option value="" >Pilih</option>
                        @foreach($m_color_merk as $item_color_merk)
                        <option value="{{$item_color_merk->id_m_color_merk}}" >{{$item_color_merk->nm_color_merk}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div> --}}




               {{-- <div class="form-group row">
                    <label for="aktif_material_gigi" class="col-sm-2 col-form-label">Aktif</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="aktif_kategori_harga" id="aktif_material_gigi">
                        <option value="1" {{$old->aktif_kategori_harga=='1' ? 'selected' : ''}}  >Ya</option>
                        <option value="0" {{$old->aktif_kategori_harga!='1' ? 'selected' : ''}}  >Tidak</option>
                      </select>
                    </div>
                  </div>

                </div> --}}


                {{-- <div class="form-group row">
                    <label for="id_dokter" class="col-sm-2 col-form-label">Dentist</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="id_dokter" id="id_dokter">

                        <option value="0" >All Dentist</option>
                        @foreach($m_user_fo as $item_user_fo)
                        <option value="{{$item_user_fo->id}}" >{{$item_user_fo->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div> --}}
                <!-- /.card-body -->



                <div class="table-responsive">
                    <table id="datatable" class="table table-striped dt-responsive nowrap table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Process</th>
                                <th>Check</th>
                                <th>Sequence</th>
                                {{-- <th>Material Details</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @php $x =1; @endphp

                            @php

                           // $table_file = \App\Models\M_produk_det::with('m_jns_pengerjaan','m_material_gigi')->where('id_input_order', \Request::get('id'))->where('id_m_jns_file','<>','1')->with('jenisfile')->orderByDesc('id_t_file')->get();
                                       // $datas = [];
                            $table_file = \App\Models\M_proses::where('tampil','1')->orderBy('id_m_proses','ASC')->get();
                            $i = 1;
                            @endphp

                             @foreach($table_file as $list_file)

                             @php

                                    //\DB::enablequerylog();
                                  $cek_isi = \App\Models\M_workflow::where('id_m_kategori_workflow', request('id'))->where('id_m_proses', $list_file->id_m_proses)->first();

                                   // dd(\DB::getquerylog());
                             @endphp
                            <tr>
                                <td>{{$x++}}</td>
                                <td>{{$list_file->nm_proses}} - {{$list_file->id_m_proses}}</td>
                                <td>
                                    <div class="col-sm-8">
                                      {{-- <input type="hidden" value="{{$list_file->id_m_produk_det}}" name="rowget[]" /> --}}
                                      <input type="checkbox" value="{{$list_file->id_m_proses}}" name="id_m_proses[]" id="id_m_proses[]" {{$cek_isi?"checked":''}} />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text"
                                        style="text-align: right"
                                        class="form-control"
                                        name="urut_workflow_{{$list_file->id_m_proses}}"
                                        id="urut_workflow_{{$list_file->id_m_proses}}"
                                        value="{{$cek_isi?$cek_isi->urut_workflow:''}}">
                                      </div>

                                </td>


                                </tr>
                                @endforeach

                        </tbody>
                    </table>
                          </div>



                <div class="card-footer">
                  <button type="submit" id="submitform" class="btn btn-info"><span>Simpan</span></button>
                  <a class="btn btn-default float-right" href="{{route('dashboard.m_kategori_workflow.index')}}">Batal</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


@endsection

@section('js')
<script>
    $(document).ready( function () {
        $("#form").submit(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text('Mohon tunggu...');

        $.ajax({
            url:"{{ route("dashboard.m_kategori_workflow.workflow_update") }}",
            method:"POST",
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            processData: false,
            contentType: false,
            success:function(data)
            {
                if($.isEmptyObject(data.error)){

                    if(data.status == true){
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Simpan');
                        $("form").each(function() { this.reset() });
                        swal.fire({
                            title: "Berhasil Menyimpan Data !",
                            text: "Berhasil Menyimpan Data !",
                            icon: "success"
                        }).then(function() {
                            location.href = data.redirect;
                        });
                    }else{
                      swal.fire("Telah terjadi kesalahan pada sistem", data.message, "error");
                    }

                }else{
                    swal.fire("Terjadi kesalahan input!", "cek kembali inputan anda", "warning");
                    $("#submitform").removeAttr('disabled');
                    $("#submitform span").text('Simpan');
                    $.each(data.error, function(key, value) {
                        var element = $("#" + key);
                        element.closest("div.form-control")
                        .removeClass("text-danger")
                        .addClass(value.length > 0 ? "text-danger" : "")
                        .find("#error_" + key).remove();
                        element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
                    });
                }
            },
            error: function(data){
                swal.fire("Telah terjadi kesalahan pada sistem", data.message, "error");
            }
        });
    });
    });

</script>

<script>

    // $('.keyinputdiscount, .keyinputhargadasar').keyup(function(event){


    //     data_produk_det = $(this).data('produk-det');

    //     var harga_dasar = parseFloat($('#harga_dasar_' + data_produk_det).val());

    //     if ($(this).val().trim().length == 0) {
    //         $('#harga_net_' + data_produk_det).val(harga_dasar);
    //         $(this).val("0");
    //     }else if($(this).val().trim().length > 0){
    //         if($(this).val().charAt(0) == 0){
    //             $(this).val("0");
    //             $('#harga_net_' + data_produk_det).val(harga_dasar);
    //         }else{
    //             var discount = parseInt($('#discount_' + data_produk_det).val());
    //             if(discount == '0'){
    //                 $('#harga_net_' + data_produk_det).val(harga_dasar);
    //             }else{
    //                 var dec = (discount/100).toFixed(2);
    //                 var potongan = harga_dasar * dec;
    //                 var harga_net = harga_dasar - potongan;
    //                 $('#harga_net_' + data_produk_det).val((potongan ? harga_net : 0).toFixed(0));
    //             }

    //         }
    //     }

    // });

    // $('.keyinputharganet').keyup(function(event){
    //     console.log(event.which);

    //     data_produk_det = $(this).data('produk-det');
    //     var harga_net = parseFloat($('#harga_net_' + data_produk_det).val());
    //     var harga_dasar = parseFloat($('#harga_dasar_' + data_produk_det).val());
    //     var discount = 100 - ((harga_net / harga_dasar) * 100);
    //     $('#discount_' + data_produk_det).val(discount.toFixed(0));
    // });


    </script>
@endsection

