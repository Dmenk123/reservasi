@extends('web.layout.index')

@section('content')
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


<h1 class="uk-article-title">{{$content->title_t_content}}</h1>
<p class="uk-text-lead uk-text-muted">{{$content->subtitle_t_content}}</p>

<div class="uk-article-meta uk-margin-top uk-margin-medium-bottom uk-flex uk-flex-middle">
    {{-- <img class="uk-border-circle avatar" src="https://via.placeholder.com/80"
    alt="Sara Galen"> --}}
    <div>
        Written by
        <span>Pramita Lab IT Dept.</span><br>
        <time>{{\Carbon\Carbon::parse($content->created_at)->format('l, d-m-Y')}}</time>
        <br>
        <a href="{{route('web.show_pdf', ['token' => request()->get('token'), 'slug' => request()->get('slug')])}}" target="_blank"><span style="color:rgb(70, 70, 233);font-style:italic;font-weight:bold;">Download this Documentation Page (PDF)</span></a>
    </div>
</div>

<div class="article-content link-primary">
    @foreach ($content_det as $key => $row)
        @if(in_array($row->id_m_component, [\App\Models\M_component::ID_M_COMPONENT_IMAGE, \App\Models\M_component::ID_M_COMPONENT_VIDEO]))
            <figure data-uk-lightbox="animation: slide" style="text-align:center;">
            <a class="uk-inline" href="{{asset('storage/'.$row->path_t_content_det)}}" data-caption="{{$row->value_m_component}}">
                <img src="{{asset('storage/'.$row->path_t_content_det)}}" alt="{{$row->value_m_component}}">
                <div class="uk-position-center">
                <span data-uk-overlay-icon></span>
                </div>
            </a>
            <figcaption data-uk-grid class="uk-flex-right uk-grid uk-grid-stack"><span
                class="uk-width-auto uk-first-column">{{$row->value_m_component}}</span></figcaption>
            </figure>

        @else

            @if ($row->m_component->open_tag_m_component)
                {!!$row->m_component->open_tag_m_component!!}
            @endif

            {!!$row->value_m_component!!}

            @if ($row->m_component->close_tag_m_component)
                {!!$row->m_component->close_tag_m_component!!}
            @endif

        @endif

    @endforeach
</div>

@endsection


@section('js')
<script>

$( document ).ready(function() {

});



</script>
@endsection
