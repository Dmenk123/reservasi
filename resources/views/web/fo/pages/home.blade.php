@extends('web.layout.index')

@section('style')
<style>
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
</style>
@endsection

@section('content')
     <!-- Start Pricing Plan -->
    <section class="st-pricing-wrap st-section" id="price">
        <div class="container">
        <div class="st-section-heading st-style2 text-center">
            <h2>Daftar Harga</h2>
            <div class="st-seperator">
            <div class="st-seperator-left-bar wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            <img src="{{asset('assets/fo/img/light-img/seperator-icon.png')}}" alt="demo" class="st-seperator-icon">
            <div class="st-seperator-right-bar wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <p>Pricing strategy in which the selling price is determined by adding a specific <br>amount markup to a product's unit cost.</p>
        </div>
        </div>
        <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="st-price-card text-center wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                    <div class="st-price-card-img"><img src="{{asset('assets/fo/img/light-img/price-img1.png')}}" alt="demo"></div>
                    <h3 class="st-price-card-title">Cash</h3>
                    <div class="st-price">
                    <h3>$19</h3>
                    <span>per month</span>
                    </div>
                    <ul class="st-price-card-feature st-mp0">
                    <li>Free Suppport 24/7</li>
                    <li>Databases Download</li>
                    <li>Maintenance Email</li>
                    <li>Unlimited Traffic</li>
                    </ul>
                    <div class="st-price-card-btn">
                    <a href="{{route('web.reservation.wizard')}}" class="st-btn st-style1 st-size1 st-color1">Pesan Cash</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="st-price-card text-center st-featured-price wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.3s">
                    <div class="st-price-card-img"><img src="{{asset('assets/fo/img/light-img/price-img2.png')}}" alt="demo"></div>
                    <h3 class="st-price-card-title">Cicilan</h3>
                    <div class="st-price">
                    <h3>$29</h3>
                    <span>per month</span>
                    </div>
                    <ul class="st-price-card-feature st-mp0">
                    <li>Free Suppport 24/7</li>
                    <li>Databases Download</li>
                    <li>Maintenance Email</li>
                    <li>Unlimited Traffic</li>
                    </ul>
                    <div class="st-price-card-btn">
                    <a href="{{route('web.reservation.wizard')}}" class="st-btn st-style1 st-size1 st-color2">Pesan cicilan</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Pricing Plan -->

@endsection

@section('js')

@endsection
