@extends('web.layout.index')

@section('content')

<div class="row">

    <div class="col-xl-8 col-md-8 col-8 offset-md-2">
        <div class="card card-statistics">
        <div class="card-body statistics-body">
            <div class="row">
                <i data-feather="unlock" class="text-orange"></i>
                <h4 class="mb-2 mt-1 text-center">{{__('auth.forgot.title_check_email')}}</h4>
                <p>
                    {{__('auth.forgot.message_check_email')}}
                </p>

            </div>
        </div>
    </div>
    </div>
</div>


@endsection




@section('js')
@endsection
