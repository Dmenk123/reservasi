<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login - Pramita MCU</title>
    {{-- <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico"> --}}
    <link href="{{asset('assets/fonts/montserrat/montserrat.css')}}" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/flatpickr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap.min.old.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap-extended.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/colors.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/components.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/semi-dark-layout.min.css"> --}}

    <!-- BEGIN: Page CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/form-flat-pickr.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/page-auth.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/style.css">
    <!-- END: Custom CSS-->


  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Login v1 -->
    <div class="card mb-0">
      <div class="card-body text-center">

        <img src="{{asset('assets/images/logo.png')}}" class="mb-3" />
        {{-- <a href="#" class="brand-logo">

          <div style="clear: booth"></div>
          <h2 class="brand-text text-primary ms-1">Pramita Lab</h2>
        </a> --}}


        <h4 class="card-title mb-1">MCU Check In & Check Out Apps</h4>
        <p class="card-text mb-2">Please Login to continue</p>

        <form class="auth-login-form mt-2" id="login_form" method="POST">
          <div class="mb-1">
            <label for="username" class="form-label">Username</label>
            <input
              type="text"
              class="form-control"
              id="username"
              name="username"
              autocomplete="off"
              placeholder="username"
              aria-describedby="username"
              tabindex="1"
            />
          </div>

          <div class="mb-1">
            <label class="form-label" for="password">Password</label>
              <input
                type="password"
                class="form-control form-control-merge"
                id="password"
                name="password"
                tabindex="2"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
              />
              {{-- <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span> --}}
          </div>



          {{-- @foreach ($m_project as $item_m_project)
          <div class="row mb-1">
            <div class="col-12">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="group_{{$item_m_project->id_m_project}}">
                        <input class="form-check-input s project" type="checkbox" value="{{$item_m_project->id_m_project}}" id="id_m_project_{{$item_m_project->id_m_project}}" name="id_m_project[]" > {{$item_m_project->nm_m_project}}
                    </label>
                </div>
            </div>
        </div>

        @endforeach --}}




          <button class="btn btn-primary w-100 mb-2" tabindex="4" id="submitform"><span>Sign in</span></button>
        </form>


      </div>
    </div>
    <!-- /Login v1 -->
  </div>
</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets/js')}}/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets/js')}}/app-menu.min.js"></script>
    <script src="{{asset('assets/js')}}/app.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/js')}}/page-auth-login.js"></script>
    <!-- END: Page JS-->

    <script src="{{asset('assets/js')}}/sweetalert2@10.js"></script>

    <script>
    $(window).on('load',  function(){
    if (feather) {
        feather.replace({ width: 14, height: 14 });
    }
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


$(document).ready(function(){
    $("#login_form").submit(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#login_form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text('Mohon tunggu...');

        $.ajax({
            url:"{{route('authenticate')}}",
            method:"POST",
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            datatype:'json',
            processData: false,
            contentType: false,
            success:function(data)
            {
                if($.isEmptyObject(data.error)){

                    if(data.status == true){
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Log In');
                        $("form").each(function() { this.reset() });
                        location.href = data.redirect;

                    }else{
                        swal.fire("Oops", data.messages, "warning");
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Log In');
                    }

                }else{
                    // swal.fire("Terjadi kesalahan input!", "cek kembali inputan anda", "warning");
                    $("#submitform").removeAttr('disabled');
                    $("#submitform span").text('Log In');
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
            error: function(){
                swal.fire("Telah terjadi kesalahan pada sistem", "Mohon refresh halaman browser Anda", "error");
                $("#submitform").removeAttr('disabled');
                $("#submitform span").text('Log In');
            }
        });
    });
});
    </script>
  </body>
  <!-- END: Body-->
</html>
