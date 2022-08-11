<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Backoffice</title>
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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/components.min.css">
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

        <a href="#" class="brand-logo">

          <div style="clear: booth"></div>
          {{-- <h2 class="brand-text text-primary ms-1">Backoffice</h2> --}}
        </a>

        <h4 class="card-title mb-1">Welcome to Backoffice</h4>
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
