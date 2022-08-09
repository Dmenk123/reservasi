    @php
        $module = \App\Models\M_module::where('id_m_app', $id_m_app)->orderBy('nm_m_module')->get();
    @endphp
        @foreach ($module as $mod)
            @php
                $hak_akses = \App\Models\M_hak_akses::whereHas('menu', function(\Illuminate\Database\Eloquent\Builder $query){
                    $query->whereNull('id_parent');
                })->where('id_m_user_group', $id_m_user_group)->where('id_m_module',$mod->id_m_module)
                ->join('m_menu', 'm_menu.id_m_menu','=','m_hak_akses.id_m_menu')->orderBy('m_menu.order_m_menu')->get();
            @endphp
            @if ($hak_akses->isNotEmpty())
                <h5>{{$mod->nm_m_module}}</h5>
            @endif

            <ul class="uk-nav uk-nav-default doc-nav">
            @foreach ($hak_akses as $item)
                <li @if(trim(request()->get('slug')) == $item->slug_m_menu) class="uk-active" @endif id="{{$item->slug_m_menu}}">
                    <a href="{{route('web.content', ['token'=> $token, 'slug'=> $item->slug_m_menu,]) }}">
                        <span @if(trim(request()->get('slug')) == $item->slug_m_menu) style="color:#149c40;font-weight:bold;" @endif>{{$item->nm_menu}}</span>
                    </a>
                </li>
                @php
                    $parent = $item->id_m_menu;

                    $sub = \DB::table('m_hak_akses')
                    ->join('m_menu','m_menu.id_m_menu','=','m_hak_akses.id_m_menu')
                    ->join('t_content', function($join) use ($id_m_app){
                        $join->on('t_content.id_m_menu', '=', 'm_menu.id_m_menu');
                        $join->where('t_content.id_m_app', '=', $id_m_app);
                        $join->where('t_content.is_active_t_content', '=', '1');
                    })
                    ->join('t_group_content', function($joni) {
                        $joni->on('t_group_content.id_t_content', '=', 't_content.id_t_content');
                        $joni->on('t_group_content.id_m_user_group', '=', 'm_hak_akses.id_m_user_group');
                    })
                    ->where('m_menu.id_parent',$parent)->orderBy('m_menu.order_m_menu')
                    ->where('m_hak_akses.id_m_user_group', $id_m_user_group)->where('id_m_module',$mod->id_m_module)->get();
                @endphp

                @if($sub->count() > 0)
                    <ul class="uk-nav uk-nav-default doc-nav">
                @endif

                @foreach($sub as $s)
                    <li @if(trim(request()->get('slug')) == $s->slug_m_menu) class="uk-active" @endif id="{{$s->slug_m_menu}}">
                        <a href="{{route('web.content', ['token'=> $token, 'slug'=> $s->slug_m_menu,]) }}"><span @if(trim(request()->get('slug')) == $s->slug_m_menu) style="color:#149c40;font-weight:bold;" @endif>{{$s->nm_menu}}</span></a>
                    </li>
                @endforeach

                @if($sub->count() > 0)
                    </ul>
                @endif
            @endforeach
            </ul>
        @endforeach
