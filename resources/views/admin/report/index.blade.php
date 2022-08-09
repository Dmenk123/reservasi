@extends('admin.layout.index')

@section('content')

              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom">
                        <h4 class="card-title">{{$page_title}}</h4>
                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable p-1">
                          <div class="row">


                                <div class="col-md-4">

                                  <div class="card" style="border: 1px solid #ddd">

                                    <div class="card-body">
                                  @php
                                      $list_report = \App\Models\M_hak_akses::whereHas('menu', function($query){
                                                        $query->where('id_parent', 41);
                                                        $query->where('id_m_menu', '<>', 42);
                                                        $query->orderBy('order_m_menu');
                                                     })->with('menu')->where('id_m_user_group',session()->get('logged_in.id_m_user_group'))->get();
                                  @endphp

                                  @foreach ($list_report as $item)
                                        <a href="{{\Route::has($item->menu->route) ? route($item->menu->route) : 'javascript:void(0)'}}" class="d-block btn mt-1 square bg-light-danger border-danger waves-effect">{{strtoupper($item->menu->nm_menu)}}</a>
                                  @endforeach

                                    </div>
                                  </div>
                                </div>



                          </div>
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
    // table = $('#datatable').DataTable({
    //     processing: true,
    //     serverside: true,
    //     pageLength: 20,
    //     ajax: {
    //         url: '{{ route('admin.m_user_group.datatable') }}',
    //         method: 'post'
    //     },
    //     columns: [
    //         { "width": "5%" },
    //         { "width": "30%" },
    //         { "width": "25%" },
    //         { "width": "15%" },
    //         { "width": "10%" },
    //         { "width": "15%" },
    //     ]
    // });
});

</script>
@endsection
