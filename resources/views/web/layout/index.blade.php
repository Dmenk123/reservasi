<!DOCTYPE html>
<html lang="en-gb" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="cipto djunaedy" />
    <meta name="description" content="" />
     <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{env('APP_NAME'); }}</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/logo.png')}}" >
    <link href="https://fonts.googleapis.com/css?family=Heebo:300,400" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/docs/css/main.css" />
    {{-- <script src="{{asset('assets')}}/docs/js/uikit.js"></script> --}}

    <link rel="stylesheet" href="{{asset('assets/fo/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/fo/css/owlCarousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/fo/css/fontawesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/fo/css/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/fo/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/fo/css/style.css')}}" />

    @yield('style')
</head>

<body>
    <div id="st-preloader">
      <div class="st-preloader-wave"></div>
      <div class="st-preloader-wave"></div>
      <div class="st-preloader-wave"></div>
      <div class="st-preloader-wave"></div>
      <div class="st-preloader-wave"></div>
    </div>

    @include('web.fo.header')

    <div class="st-content">
        {{-- comment jika tidak dibutuhkan --}}
        @include('web.fo.pages.components.hero_slider')
        @include('web.fo.pages.components.icon_box')
        @include('web.fo.pages.components.about')

        {{-- dynamic content --}}
        @yield('content')

        @include('web.fo.pages.components.service')
        {{-- @include('web.fo.pages.components.funfact') --}}
        {{-- @include('web.fo.pages.components.portfolio') --}}
        {{-- @include('web.fo.pages.components.skill') --}}
        {{-- @include('web.fo.pages.components.team') --}}
        {{-- @include('web.fo.pages.components.pricing') --}}
        {{-- @include('web.fo.pages.components.blog') --}}
        {{-- @include('web.fo.pages.components.testimonial') --}}
        @include('web.fo.pages.components.contact')

    </div>

    @include('web.fo.footer')

    <!-- Start Video Popup -->
    <div class="st-video-popup">
      <div class="st-video-popup-overlay"></div>
      <div class="st-video-popup-content">
        <div class="st-video-popup-layer"></div>
        <div class="st-video-popup-container">
          <div class="st-video-popup-align">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="about:blank"></iframe>
            </div>
          </div>
          <div class="st-video-popup-close"></div>
        </div>
      </div>
    </div>
    <!-- End Video Popup -->
    <!-- Scripts -->
    <script src="{{asset('assets/fo/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    {{-- <script src="{{asset('assets/fo/js/vendor/jquery-1.12.4.min.js')}}"></script> --}}
    <script src="{{asset('assets/fo/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('assets/fo/js/mailchimp.min.js')}}"></script>
    <script src="{{asset('assets/fo/js/owlCarousel.min.js')}}"></script>
    <script src="{{asset('assets/fo/js/tamjid-counter.min.js')}}"></script>
    <script src="{{asset('assets/fo/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/fo/js/partical.js')}}"></script>
    <script src="{{asset('assets/fo/js/main.js')}}"></script>


    @yield('js')
  </body>
</html>
