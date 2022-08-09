<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css')}}/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/vendors.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/bootstrap.min.old.css"> --}}
    <script src="{{asset('assets/js')}}/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/form-flat-pickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/flatpickr.min.css">
    <link href="{{asset('assets/css/gijgo.min.css')}}" rel="stylesheet" type="text/css" />
    <title>Pramita Medical Check Up</title>
    <style>
        body{
            background: #F2F2F2;
        }
        .container{
            background: #ffffff;
            border: 1px solid #E0E0E0;
        }
        @media only screen and (min-width: 992px) {
            .container{
                background: #ffffff;
                border: 1px solid #E0E0E0;
                width: 75%!important;
            }
        }
        .gj-textbox-md {
            border: none!important;
            border: 1px solid rgba(0,0,0,.42)!important;
            display: block!important;
            font-family: Helvetica,Arial,sans-serif!important;
            font-size: 16px!important;
            line-height: 20px!important;
            padding: 8px!important;
            margin: 0!important;
            /* margin-top: 3px!important; */
            width: 100%!important;
            background: 0 0!important;
            text-align: left!important;
            color: rgba(0,0,0,.87)!important;
        }

        .gj-datepicker-md [role=right-icon] {
            position: absolute!important;
            right: 0!important;
            top: 7px!important;
            font-size: 24px!important;
        }
    </style>
  </head>
  <body>

    <div class="container my-2">
        <div class="wrap">
            <div class="row">
                <div class="col-md-12 mt-1 p-2">
                    <h4 class="text-center">
                        <img src="{{asset('assets/images/logo_pramita.png')}}" width="150" valign="middle" />
                        <br>
                        {{-- <span style="color: red;">PT. PRAMITA</span> --}}
                        {{-- <br>Medical Check Up (MCU) Guest Book --}}
                        <span style="color: red;">Laboratorium Klinik PRAMITA</span>
                    </h4>
                    <hr>
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
    {{-- <p class="text-center">PRAMITA, PT. &copy; 2021 Allrights Reserved</p> --}}



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="{{asset('assets/js')}}/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/js')}}/sweetalert2@10.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="{{asset('assets/js')}}/flatpickr.min.js"></script>
    <script src="{{asset('assets/js')}}/select2.full.min.js"></script>
    <script src="{{asset('assets/js')}}/form-select2.min.js"></script>

    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="{{asset('assets/js/gijgo.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js')}}/select2.full.min.js"></script>
<script src="{{asset('assets/js')}}/form-select2.min.js"></script>


    <script>


        var toket;
        const loading_text = 'Please wait...';
        const data_saved = "{{__('notif.berhasil_simpan')}}";
        const data_deleted = "{{__('notif.berhasil_hapus')}}";
        const confirm_delete_text = "{{__('notif.swal_confirm_delete')}}";

        function displayErrorSwal(msg){
          if(msg == null){
            swal.fire("Oops !","{{__('notif.swal_error')}}" , "error");
          }else{
            swal.fire("Oops !", msg, "error");
          }
          $("#submitform").removeAttr('disabled');
          $("#submitform span").text('Submit');
        }


        function displayWarningSwal(msg){
          if(msg == null){
              swal.fire("Oops !", "{{__('notif.swal_warning')}}", "warning");
          }else{
              // swal.fire("Oops !", msg, "warning");
              swal.fire({
                title: "Oops !",
                html: msg,
                icon: "warning",
                // showCancelButton: !0,
                // confirmButtonText: "Yes",
                // cancelButtonText: "No",
                // reverseButtons: !0
            }).then(function (e) {
              return;
            })
          }
        }

        // $(".datepicker").flatpickr(
        //   {
        //       dateFormat: "d-m-Y",
        //       static:true

        //       // minDate: "today",
        //       // maxDate: new Date().fp_incr(14) // 14 days from now
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

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
  </script>

      @yield('js')
  </body>
</html>
