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
        <div class="row" style="width:100%;display:block!important">
            <div class="icon-box" style="transition: none;transform: none;">
                <h5>Pilih Jam :</h5>
                <div class="row" id="pilihjam">
                </div>
                <div class="loading" style="justify-content: center">
                    <span class="throbber-loader" style="display: none">
                    </span>
                </div>
            </div>
        </div>

          

    </div>
</section>

@endsection
@section('custom_js')
<script type="text/javascript">
    var get_data = '[{"id":52,"title":"12","rutin":2,"start":"2022-08-12","color":"#00e12a"},{"id":52,"title":"19","rutin":2,"start":"2022-08-19","color":"#00e12a"}]';
    $(document).ready(function() {
        $('.date-picker').datepicker();
        $('#calendarIO').fullCalendar({
            header: {
            left: 'prev',
            center: 'title',
            right: 'next'
            },
            defaultDate: moment().format('YYYY-MM-DD'),
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {

            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position
            editDropResize(event);
            },
            eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur
            editDropResize(event);
            },
            eventClick: function(event, element) {
            deteil(event);
            },
            events: JSON.parse(get_data)
        });

    });

    function deteil(event)
    {
        $.ajax({
            url: "{{ route('booking.get-jam')  }}",
            method: 'post',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
            'id': +event.id,
            'tanggal': +event.start,
            'rutin': +event.rutin
            },
            async: false,
            beforeSend: function() {
                $('.throbber-loader').show();  
                $('#pilihjam').html('');
            },
            success: function(response) {
                setTimeout(function () {
                    $('.throbber-loader').hide();   
                    
                    $('#pilihjam').html(response);
                }, 2000);
               

            },
            error: function() {}
        });
    }
</script>
@endsection

			
		