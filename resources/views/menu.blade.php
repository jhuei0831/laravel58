@extends('_layouts.home.app')
@section('title',$select_menu->name)
@section('menu')
{{-- 選單顯示 --}}
<div id="menu" class="col-md-2 invisible">
    <nav class="navbar navbar-vertical" data-toggle="affix">
        <div class="collapse navbar-collapse" id="pnlSubNavbar">
            <ul class="nav navbar-nav">
                @foreach($menus_nav as $menu)
                    @if($menu->name == $select_menu->name)
                        <li class="active">
                            <a class="nav-link" href="/article/{{ $navbar->name }}/{{ $menu->name }}">{{ $menu->name }}</a>
                        </li>
                    @elseif($menu->link)
                        <li class="">
                            <a class="nav-link" href="{{ $menu->link }}">{{ $menu->name }}</a>
                        </li>
                    @else
                        <li class="">
                            <a class="nav-link" href="/article/{{ $navbar->name }}/{{ $menu->name }}">{{ $menu->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</div>
@endsection

@section('content')
{{-- 頁面顯示 --}}
@if(Request::getQueryString())
    <div id="content" class="col-md-12">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$current_page->title}}</b></h1>
            </div>
            <div class="card-body">
                {!! clean($current_page->content) !!}
            </div>
            <div class="card-footer bg-transparent">
                <p><span class="badge badge-pill badge-primary">{{ __('Editor').' : '.$current_page->editor }}</span></p>
                <p><span class="badge badge-pill badge-primary">{{ __('Created_at').' : '.$current_page->created_at }}</span></p>
                <p><span class="badge badge-pill badge-primary">{{ __('Updated_at').' : '.$current_page->updated_at }}</span></p>
            </div>
        </div>
    </div>
{{-- 是否清單顯示 --}}
@elseif($select_menu->is_list)
    <div id="content" class="col-md-12">
        <div class="card border-light" style="border: none;">
            <div class="card-header bg-transparent">
                <h1><b>{{$select_menu->name}}</b></h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <tbody>
                        @foreach($menu_pages as $page)
                            @if($page->menu_id == $select_menu->id)
                            <tr>
                                <td width=10%>{{ $page->updated_at->format('Y/m/d') }}</td>
                                <td class="text-list"><a href="{{ route('page', [$navbar->name,$select_menu->name,$page->url]) }}">{{ $page->title }}</a></td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer pagination justify-content-center bg-transparent">
                {!! $menu_pages->links("pagination::bootstrap-4") !!}
            </div>
        </div>
    </div>
@else
    <div id="content" class="col-md-12">
        <div class="card border-light" style="border: none;">

            <div class="card-header bg-transparent">
                <h1><b>{{$menu_pages->title}}</b></h1>
            </div>
            <div class="card-body">
                {!! clean($menu_pages->content) !!}
            </div>
        </div>
    </div>
@endif
@endsection
@section('script')
@parent
<script>

$(document).ready(function() {
    $(window).on('load',function(){
        $('#my_modal').modal('show');
    });
    $('#toggle').on('click', function() {
        if ($('#pnlSubNavbar').hasClass('show')) {
            $('#toggle').removeClass("fa-eye-slash").addClass("fa-eye");
            $('#menu').removeClass("visible").addClass("invisible");
            $('#content').removeClass("col-md-10").addClass("col-md-12");
        }else {

            $('#toggle').removeClass("fa-eye").addClass("fa-eye-slash");
            $('#menu').removeClass("invisible").addClass("visible");
            $('#content').removeClass("col-md-12").addClass("col-md-10");
        }
    });
});

</script>
@show
