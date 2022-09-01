@extends('admin.layout.index')

@section('content')


              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom">
                        <h4 class="card-title">{{$page_title}}</h4>

                        <a href="{{route('admin.m_harga.add')}}" class="btn btn-success float-right"><i data-feather="plus"></i> Add New</a>
                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable">
                        <table id="datatable" class="table-striped table-sm table-hover table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nominal</th>
                              <th>Cicilan</th>
                              <th>Jangka</th>
                              <th>Status</th>
                              <th>Created at</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
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

var table;

$(document).ready( function () {
    table = $('#datatable').DataTable({
        processing: true,
        serverside: true,
        pageLength: 20,
        ajax: {
            url: '{{ route('admin.m_harga.datatable') }}',
            method: 'post'
        },
    });
});


$('#datatable').on('click', '.nonActive', function(){
    var id_m_harga = $(this).data("id_m_harga");
    swal.fire({
        title: "Confirmation",
        text: 'Yakin Nonaktif master ?',
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        reverseButtons: !0
    }).then(function (e) {

        if(e.value){
            $.ajax({
                url:"{{ route('admin.m_harga.nonaktif') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{id_m_harga:id_m_harga},
                success:function(data)
                {
                    if(data.status == true){
                        swal.fire({
                            title: "Nonaktif!",
                            text: 'Data dinonaktifkan',
                            icon: "success"
                        }).then(function() {
                            table.ajax.reload();
                        });
                    }else{
                        displayErrorSwal(data.message);
                    }
                },
                error: function(data){
                    displayErrorSwal(data.message);
                }
            });
        }

        })
});
</script>
@endsection
