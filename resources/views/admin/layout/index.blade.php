
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Pramita Lab</title>
    {{-- <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico"> --}}
    {{-- <link href="{{asset('assets/fonts/montserrat/montserrat.css')}}" rel="stylesheet"> --}}

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/form-flat-pickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/flatpickr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap.min.old.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/colors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/components.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/semi-dark-layout.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/form-wizard.min.css">

    <!-- END: Page CSS-->

     <!-- BEGIN: FORM WIZARD CSS-->
     <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/vertical-menu.min.css">
     <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/form-flat-pickr.min.css">
     <!-- END: Page CSS-->


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/style.css">
    <link href="{{asset('assets/css')}}/quill.snow.css" rel="stylesheet">
    <!-- END: Custom CSS-->

    <link href="{{asset('assets/css/gijgo.min.css')}}" rel="stylesheet" type="text/css" />


  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center fixed-top navbar-light navbar-shadow">
      <div class="navbar-container d-flex content justify-content-between">
        <div class="bookmark-wrapper d-flex align-items-center">
          <ul class="nav navbar-nav d-xl-none">
            <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
          </ul>

        </div>
        <ul class="nav navbar-nav align-items-center">

            {{-- <li class="nav-item dropdown dropdown-user">
                <a class="square btn btn-primary btn-sm">{{request()->segment(2)}}</a>
            </li> --}}

          <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">Hi, {{session()->get('logged_in.nm_user')}}</span><span class="user-status">You logged in as <span class="text-success">{{session()->get('logged_in.nm_user_group')}}</span></span></div><span class="avatar">
                  {{-- <img class="round" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"> --}}
                  <span class="avatar-status-online"></span></span></a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                {{-- <a class="dropdown-item" href="page-profile.html"><i class="me-50" data-feather="user"></i> Profile</a> --}}
                <a class="dropdown-item" href="{{route('admin.edit_profile')}}"><i class="me-50" data-feather="settings"></i> Edit Profile</a>
                <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="me-50" data-feather="power"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <ul class="main-search-list-defaultlist-other-list d-none">
      <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
          <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div></a></li>
    </ul>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" style="box-shadow: 0 8px 24px 5px rgb(24 31 35 / 20%);" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('admin.main')}}">
            <span class="brand-logo">
          </span>
              <h2 class="brand-text">Pramita Docs</h2></a></li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('admin.main')}}"><i data-feather="home"></i><span class="menu-title text-truncate">Dashboards</span></a>

          </li>

          @php
         // $convert_module_to_id = \App\Models\M_module::where('slug_m_module', request()->segment(2))->firstOrFail()->id_m_module;


        // $hak_akses = \App\Models\M_hak_akses::whereHas('menu', function(\Illuminate\Database\Eloquent\Builder $query){
        //     $query->whereNull('id_parent');
        //   })->where('id_m_user_group', session('logged_in.id_m_user_group'))->where('id_m_module',$convert_module_to_id)
        //   ->join('m_menu', 'm_menu.id_m_menu','=','m_hak_akses.id_m_menu')->orderBy('m_menu.order_m_menu')->get();

          $hak_akses = \App\Models\M_hak_akses_bo::whereHas('menu', function(\Illuminate\Database\Eloquent\Builder $query){
            $query->whereNull('id_parent');
          })
            ->where('id_m_user_group_bo', session('logged_in.id_m_user_group'))
            ->join('m_menu_bo', 'm_menu_bo.id_m_menu_bo','=','m_hak_akses_bo.id_m_menu_bo')
            ->orderBy('m_menu_bo.order_m_menu_bo')
            ->groupBy('m_menu_bo.id_m_menu_bo')
            ->get();
          @endphp

          @foreach ($hak_akses as $item)
          <li class="nav-item">
            <a class="d-flex align-items-center" href="{{($item->menu->route) ? route($item->menu->route) : 'admin.t_content.index'}}"><i data-feather="{{$item->menu->icon}}"></i><span class="menu-title text-truncate"><b>{{$item->menu->nm_menu_bo}}</b></span></a>
            @php
                $parent = $item->id_m_menu_bo;
                $sub = \DB::table('m_hak_akses_bo')
                        ->join('m_menu_bo','m_menu_bo.id_m_menu_bo','=','m_hak_akses_bo.id_m_menu_bo')
                        ->where('m_menu_bo.id_parent',$parent)
                        ->groupBy('m_menu_bo.id_m_menu_bo')
                        ->orderBy('m_menu_bo.order_m_menu_bo')
                        ->where('m_hak_akses_bo.id_m_user_group_bo', session('logged_in.id_m_user_group'))->get();
            @endphp

            @if($sub->count() > 0)
            <ul class="menu-content">
            @endif
              @foreach($sub as $s)

              @if($s->id_m_menu_bo != 42 and $s->id_parent == 41)
              {{-- hide semua menu sub laporan { KARENA NANTINYA DIJADIKAN SATU CONSOLE } --}}
              @else
              <li class="@if($child_menu_active == $s->nm_menu_bo) active @endif">
                  <a data-bs-toggle="tooltip" data-bs-placement="right"
                    title data-bs-original-title="{{$s->nm_menu_bo}}" class="d-flex align-items-center"
                    href="{{\Route::has($s->route) ? route($s->route,['menu'=>$s->id_m_menu_bo, 'process'=>$s->id_m_process]) : '#'}}">
                    <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">{{$s->nm_menu_bo}}</span>
                  </a>
              </li>
              @endif
              @endforeach
              {{--<li class="active"><a class="d-flex align-items-center" href="table-datatable-advanced.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Advanced">Advanced</span></a>
              </li>--}}
            @if($sub->count() > 0)
            </ul>
            @endif
          </li>

          @endforeach

          {{-- <li class=" nav-item">
              <a class="d-flex align-items-center" href="table-bootstrap.html"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Table">Table</span></a>
          </li> --}}

        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        {{-- <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div> --}}
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.main')}}">Home</a></li>
                                    <li class="breadcrumb-item active">{{$page_title}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body"><!-- Ajax Sourced Server-side -->
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
      <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT  &copy; 2022 Pramita Lab<span class="d-none d-sm-inline-block"></span></span></p>
    </footer>

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->




    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets/js')}}/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/js')}}/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js')}}/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('assets/js')}}/dataTables.responsive.min.js"></script>
    <script src="{{asset('assets/js')}}/responsive.bootstrap4.js"></script>
    <script src="{{asset('assets/js')}}/flatpickr.min.js"></script>
    <script src="{{asset('assets/js')}}/select2.full.min.js"></script>
    <script src="{{asset('assets/js')}}/form-select2.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets/js')}}/app-menu.min.js"></script>
    <script src="{{asset('assets/js')}}/app.min.js"></script>
    <script src="{{asset('assets/js')}}/customizer.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('assets/js')}}/table-datatables-advanced.min.js"></script> --}}
    <!-- END: Page JS-->

    <script src="{{asset('assets/js')}}/sweetalert2@10.js"></script>

    <script src="{{asset('assets/js')}}/quill.js"></script>
    <script src="{{asset('assets/js')}}/flatpickr.min.js"></script>

     <!-- BEGIN: STEPPER FORM WIZARD JS-->
    <script src="{{asset('assets/js')}}/bs-stepper.min.js"></script>
    <!-- END: Page JS-->

    {{-- tinyMCE include --}}
    <script src="{{asset('assets/js/tinymce')}}/tinymce.min.js"></script>

    <script src="{{asset('assets/js/gijgo.min.js')}}" type="text/javascript"></script>

    <script>
      $(window).on('load',  function(){
        if (feather) {
          feather.replace({ width: 14, height: 14 });
        }
      })

      const loading_text = 'Please wait...';
      const data_saved = 'Data Saved';
      const data_deleted = 'Data Deleted';
      const confirm_delete_text = 'Are you sure you want to delete this data ?';

      $(document).ready(function() {
          $('.datepicker').each(function() {
              $(this).datepicker({
                  format: "dd-mm-yyyy",
                  endDate: "0d",
                  clearBtn: true,
                  todayBtn: true,
                  todayHighlight: true,
                  forceParse: false
              });
          });
          // $('.today').text(today);
      });

      function displayErrorSwal(msg){
        if(msg == null){
          swal.fire("Oops !", "Server Error. Please contact our administrator", "error");
        }else{
          swal.fire("Oops !", msg, "error");
        }
        $("#submitform").removeAttr('disabled');
        $("#submitform span").text('Submit');
      }


      function displayWarningSwal(msg){
        if(msg == null){
            swal.fire("Oops !", "Please correct your input form", "warning");
        }else{
            swal.fire("Oops !", msg, "warning");
        }
      }

      // $(".datepicker").flatpickr(
      //   {
      //       dateFormat: "d-m-Y",
      //   }
      // );

      $(".timepickerpicker").flatpickr(
        {
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
        }
      );


      $(".timepicker").flatpickr(
        {
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
        }
      );

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>

    @yield('js')


  </body>
  <!-- END: Body-->
</html>
