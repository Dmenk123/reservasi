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
                    <label for="nm_material" class="col-sm-2 col-form-label">Kategori Harga</label>
                    <div class="col-sm-10">
                      <input type="hidden"  class="form-control" value="{{$old->id_m_kategori_harga}}" name="id_m_kategori_harga" id="id_m_kategori_harga">
                      <input type="text"  class="form-control" name="nm_kategori_harga" value="{{$old->nm_kategori_harga}}" id="nm_kategori_harga">
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


               <div class="form-group row">
                    <label for="aktif_material_gigi" class="col-sm-2 col-form-label">Aktif</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="aktif_kategori_harga" id="aktif_material_gigi">
                        <option value="1" {{$old->aktif_kategori_harga=='1' ? 'selected' : ''}}  >Ya</option>
                        <option value="0" {{$old->aktif_kategori_harga!='1' ? 'selected' : ''}}  >Tidak</option>
                      </select>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->



                <div class="table-responsive">
                    <table id="datatable" class="table table-striped dt-responsive nowrap table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Base Price</th>
                                <th>Discount</th>
                                <th>Nett Price</th>

                                {{-- <th>Material Details</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @php $x =1; @endphp

                            @php

                           // $table_file = \App\Models\M_produk_det::with('m_jns_pengerjaan','m_material_gigi')->where('id_input_order', \Request::get('id'))->where('id_m_jns_file','<>','1')->with('jenisfile')->orderByDesc('id_t_file')->get();
                                       // $datas = [];
                            $table_file = \App\Models\M_produk_det::with('m_jns_pengerjaan','m_material_gigi')->orderByDesc('id_m_produk_det')->get();
                            $i = 1;




                            @endphp


                             @foreach($table_file as $list_file)
                            <tr>
                                <td>{{$x++}}</td>
                                <td>{{$list_file->m_jns_pengerjaan->nm_jns_pengerjaan}} - {{$list_file->m_material_gigi->nm_material_gigi}}</td>
                                <td>
                                    <div class="col-sm-8">
                                        <input type="text"  class="form-control" name="harga_dasar" id="harga_dasar">
                                      </div>
                                </td>
                                <td>
                                    <div class="col-sm-8">
                                        <input type="text"  class="form-control" value="0" name="discount" id="discount">
                                      </div>

                                </td>
                                <td>
                                    <div class="col-sm-8">
                                        <input type="text"  class="form-control" name="harga_net" id="harga_net">
                                      </div>

                                </td>

                                </tr>
                                @endforeach

                        </tbody>
                    </table>
                          </div>



                <div class="card-footer">
                  <button type="submit" id="submitform" class="btn btn-info"><span>Simpan</span></button>
                  <a class="btn btn-default float-right" href="{{route('dashboard.m_kategori_harga.index')}}">Batal</a>
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
            url:"{{ route("dashboard.m_kategori_harga.update") }}",
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
    // function sum() {
    //       var harga_dasar = document.getElementById('harga_dasar').value;
    //       var discount = document.getElementById('discount').value;
    //       var result = parseInt(harga_dasar)-((parseInt(discount)/100) * parseInt(harga_dasar));
    //       if (!isNaN(result)) {
    //          document.getElementById('harga_net').value = result;
    //       }
    // }


    $('#discount, #harga_dasar').on('input',function() {
        var harga_dasar = parseFloat($('#harga_dasar').val());
        var discount = parseInt($('#discount').val());
        var dec = (discount/100).toFixed(2);
        var potongan = harga_dasar * dec;
        var harga_net = harga_dasar - potongan;
        $('#harga_net').val((potongan ? harga_net : 0).toFixed(0));
    });

    $('#harga_net').on('input',function() {
        var harga_net = parseFloat($('#harga_net').val());
        var harga_dasar = parseFloat($('#harga_dasar').val());
        var discount = 100 - ((harga_net / harga_dasar) * 100);
        $('#discount').val(discount.toFixed(0));
    });

// hargasatuan = document.formD.harga.value;
//    document.formD.txtDisplay.value = hargasatuan;
//    jumlah = document.formD.jmlpsn.value;
//    document.formD.txtDisplay.value = jumlah;
//    function OnChange(value){
//      hargasatuan = document.formD.harga.value;
//      jumlah = document.formD.jmlpsn.value;
//      total = hargasatuan * jumlah;
//      document.formD.txtDisplay.value = total;
//    }
    </script>
@endsection


s
