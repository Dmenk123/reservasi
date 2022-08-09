
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Pramita HRMS</title>
    {{-- <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico"> --}}
    <link href="{{asset('assets/fonts/montserrat/montserrat.css')}}" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/select2.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/colors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/components.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/semi-dark-layout.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/form-flat-pickr.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/style.css">
    <link href="{{asset('assets/css')}}/quill.snow.css" rel="stylesheet">
    <!-- END: Custom CSS-->
    <style>
        html .content {
            margin-left: 0px!important;
        }
    </style>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 1-column navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
          <div class="content-body"><!-- Ajax Sourced Server-side -->

            <div class="col-xl-12 col-md-12 col-12">
                <div class="card card-statistics">
                  <div class="card-header">
                    <h4 class="card-title">Human Resource Management Systems of PRAMITA</h4>

                    <p class="text-white mt-1">You Logged in as : {{session()->get('logged_in.nm_user')}}, <a class="btn bg-white btn-sm text-danger shadow-sm" href="{{route('admin.logout')}}">Logout</a></p>
                  </div>
                  <div class="card-body statistics-body">
                    <div class="row">

                      @foreach($modules as $mod)
                      <div class="col-xl-3 my-1 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="d-flex shadow-sm bg-light-primary py-2 px-1 rounded flex-row">
                          <div class="avatar text-danger" style="background: transparent;">
                            <div class="avatar-content">
                                <i data-feather="box" class="avatar-icon"></i>
                            </div>
                          </div>
                          <div class="my-auto">
                            <a href="{{url('admin'.'/'.\Str::slug($mod->nm_m_module.'/')).'/main'}}">
                            <h5 class="fw-bolder mb-0">{{ucwords(strtolower($mod->nm_m_module))}}</h5>
                            {{-- <p class="card-text font-small-3 mb-0">Click to open this module</p> --}}
                            </a>
                          </div>
                        </div>
                      </div>
                      @endforeach

                    </div>
                  </div>
                </div>
              </div>


           </div>
        </div>
    </div>
<!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
      <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT  &copy; 2021 Pramita Human Resources Management System<span class="d-none d-sm-inline-block"></span></span></p>
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
    </script>

    @yield('js')
  </body>
  <!-- END: Body-->
</html>
