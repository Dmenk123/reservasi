@extends('web.layout.index')

@section('style')
{{-- <style>
    .select2-selection__rendered {
        line-height: 40px !important;
    }
    .select2-container .select2-selection--single {
        height: 40px !important;
        width: 100% !important;
        margin-top: 10px;
    }
    .select2-selection__arrow {
        height: 40px !important;
        width: 100% !important;
        margin-top: 10px;
    }
    .select2-container{
        width: 100%!important;
    }
    .select2-search--dropdown .select2-search__field {
        width: 98%;
    }

    #footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style> --}}
{{-- <link href="{{asset('assets/fo/css/bootstrap.min.css')}}" rel="stylesheet" /> --}}
{{-- <link href="{{asset('assets/fo/css/paper-bootstrap-wizard.css')}}" rel="stylesheet" /> --}}
{{-- <link href="{{asset('assets/fo/css/demo.css')}}" rel="stylesheet" /> --}}
<!-- Fonts and Icons -->
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
{{-- <link href="{{asset('assets/fo/css/themify-icons.css')}}" rel="stylesheet"> --}}
@endsection

@section('content')
     <!-- Start Pricing Plan -->
    <section class="st-pricing-wrap st-section" id="price">

    </section>
    <!-- End Pricing Plan -->

@endsection

@section('js')
    <!--   Core JS Files   -->
	{{-- <script src="{{asset('assets/fo/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script> --}}
	{{-- <script src="{{asset('assets/fo/js/bootstrap.min.js')}}" type="text/javascript"></script> --}}
	{{-- <script src="{{asset('assets/fo/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script> --}}

	<!--  Plugin for the Wizard -->
	{{-- <script src="{{asset('assets/fo/js/demo.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/fo/js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script> --}}
@endsection
