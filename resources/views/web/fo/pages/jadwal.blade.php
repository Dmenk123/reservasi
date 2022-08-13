@extends('web.layout.app')

			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
@section('content')

<!-- ======================= Content ======================== -->
<section class="space gray">
    <br>
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center mb-5">
                    <h6 class="text-muted mb-0"></h6>
                    <h2 class="ft-bold">Pilih Jadwal</h2>
                </div>
            </div>
        </div>
        

    


        
        <div class="row">
            <div class="icon-box" style="transition: none;transform: none;">
            <div id="calendarIO"></div>
            </div>
        </div>
        <div class="row">
            <div class="icon-box" style="transition: none;transform: none;">
            <h5>Pilih Jam :</h5>
            <div class="row" id="pilihjam">
    
            </div>
            </div>
        </div>

          

    </div>
</section>

@endsection
			
		