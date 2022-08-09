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
<link href="{{asset('assets/fo/css/paper-bootstrap-wizard.css')}}" rel="stylesheet" />
{{-- <link href="{{asset('assets/fo/css/demo.css')}}" rel="stylesheet" /> --}}
<!-- Fonts and Icons -->
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href="{{asset('assets/fo/css/themify-icons.css')}}" rel="stylesheet">
@endsection

@section('content')
     <!-- Start Pricing Plan -->
    <section class="st-pricing-wrap st-section" id="price">
        <div class="container">
            {{-- <div class="row"> --}}
                <div class="wizard-container">
                    <div class="st-section-heading st-style2 text-center">
                        <h2>Daftar Harga</h2>
                        <div class="st-seperator">
                        <div class="st-seperator-left-bar wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
                        <img src="{{asset('assets/fo/img/light-img/seperator-icon.png')}}" alt="demo" class="st-seperator-icon">
                        <div class="st-seperator-right-bar wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
                        </div>
                        <p>Pricing strategy in which the selling price is determined by adding a specific <br>amount markup to a product's unit cost.</p>
                    </div>
                    <div class="card wizard-card" data-color="blue" id="wizard">
                        <form action="" method="">
                            <!--        You can switch " data-color="azure" "  with one of the next bright colors: "blue", "green", "orange", "red"           -->

                            <div class="wizard-header">
                                <h3 class="wizard-title">Find your next desk</h3>
                                <p class="category">Book from thousands of unique work and meeting spaces.</p>
                            </div>

                            <div class="wizard-navigation">
                                <div class="progress-with-circle">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
                                </div>
                                <ul>
                                    <li class="active">
                                        <a href="#details" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-list"></i>
                                            </div>
                                            Details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#captain" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-briefcase"></i>
                                            </div>
                                            Timetable
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#description" data-toggle="tab">
                                            <div class="icon-circle">
                                                <i class="ti-pencil"></i>
                                            </div>
                                            Description
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane" id="details">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="info-text"> Let's start with the basic details</h5>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>What city do you want to work in?</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="e.g Silicon Valley">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Space</label>
                                                <select class="form-control">
                                                    <option disabled="" selected="">- choose a space -</option>
                                                    <option>Work Space</option>
                                                    <option>Meeting Space</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>Type of Desk</label>
                                                <select class="form-control">
                                                    <option disabled="" selected="">- choose an option -</option>
                                                    <option>Private</option>
                                                    <option>Shared</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Monthly Budget</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control">
                                                    <span class="input-group-addon">$</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="captain">
                                    <h5 class="info-text">How do you want to rent the office? </h5>
                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <div class="choice" data-toggle="wizard-checkbox">
                                                    <input type="checkbox" name="jobb" value="Design">
                                                    <div class="card card-checkboxes card-hover-effect">
                                                        <i class="ti-time"></i>
                                                        <p>By hour</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="choice" data-toggle="wizard-checkbox">
                                                    <input type="checkbox" name="jobb" value="Design">
                                                    <div class="card card-checkboxes card-hover-effect">
                                                        <i class="ti-calendar"></i>
                                                        <p>By day</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="description">
                                    <div class="row">
                                        <h5 class="info-text"> Tell us about your ideal working space. </h5>
                                        <div class="col-sm-6 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>Desk description</label>
                                                <textarea class="form-control" placeholder="" rows="9"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Example</label>
                                                <p class="description">"If you're heavily armed with a mug, smartphone and a laptop, then our hot desks will provide the pure functionality and space needed to get your work done and move on to the next one."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-primary btn-wd' name='next' value='Next' />
                                    <input type='button' class='btn btn-finish btn-fill btn-primary btn-wd' name='finish' value='Finish' />
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </form>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </section>
    <!-- End Pricing Plan -->

@endsection

@section('js')
    <!--   Core JS Files   -->
	{{-- <script src="{{asset('assets/fo/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script> --}}
	<script src="{{asset('assets/fo/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/fo/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="{{asset('assets/fo/js/demo.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/fo/js/paper-bootstrap-wizard.js')}}" type="text/javascript"></script>
@endsection
