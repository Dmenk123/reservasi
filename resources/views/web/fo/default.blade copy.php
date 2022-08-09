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

<h1 class="uk-article-title">Halaman Utama</h1>
<p class="uk-text-lead uk-text-muted">Berikut merupakan halaman utama dari Dokumentasi {{$app->nm_m_app}}</p>
<div class="uk-article-meta uk-margin-top uk-margin-medium-bottom uk-flex uk-flex-middle">
    <div>
        Written by
        <span>Pramita Lab IT Dept.</span><br>
        <time>{{\Carbon\Carbon::parse('2022-06-15')->format('l, d-m-Y')}}</time>
    </div>
</div>
<div class="article-content link-primary">
    <p>Selamat datang di Sistem Dokumentasi aplikasi {{$app->nm_m_app}}. Silahkan untuk klik menu di samping kiri <span style="font-style:italic;">(sidebar)</span> untuk melihat Dokumentasi. </p>
    <p>Anda dapat juga melakukan pencarian pada <span style="font-style:italic;">Search Bar</span> diatas dengan cara memasukkan kata kunci <span style="font-style:italic;">(keyword)</span> lalu tekan <b>Enter</b> untuk melakukan pencarian.</p>
    <p>Terimakasih. Semoga bermanfaat.</p>
</div>


@endsection


@section('js')
@endsection
