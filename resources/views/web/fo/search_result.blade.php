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

<h2 class="uk-article-title">Search Results</h2>
<div class="article-content link-primary">
    <p>
        Here are the results of your search "{{request()->get('search')}}" <br>
        If your search results are not found, please repeat searching again using the correct keywords. Thanks.
    </p>

    {{-- @php
        dd($menu_by_akses);
    @endphp --}}

    @if ($menu_by_akses->isNotEmpty())
    <ul>
        @foreach ($menu_by_akses as $item)
        <li><a href="{{route('web.content', ['token'=> $token, 'slug'=> $item->slug_m_menu]) }}">{{$item->nm_menu}}</a></li>
        @endforeach
    </ul>
    @endif
</div>


@endsection


@section('js')

@endsection
