<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ trans('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @foreach ($navbars as $navbar)
                    @switch($navbar->type)
                        @case(1)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $navbar->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{-- @foreach ($menus as $menu)
                                    @if ($menu->navbar_id == $navbar->id && $menu->link)
                                        <a class="dropdown-item" target="_blank" href="{{ $menu->link }}">{{ $menu->name }}</a>
                                    @elseif($menu->navbar_id == $navbar->id)
                                        <a class="dropdown-item" href="/article/{{ $navbar->name }}/{{ $menu->name }}">{{ $menu->name }}</a>
                                    @endif
                                @endforeach --}}
                                </div>
                            </li>
                            @break
                        @case(2)
                            <li class="nav-item" >
                                <a class="nav-link" href="{{ $navbar->link }}">{{ $navbar->name }}</a>
                            </li>
                            @break
                    @endswitch
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ trans('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ trans('Register') }}</a>
                        </li>
                    @endif
                @else
                @if (Auth::user()->permission != 0)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manage') }}">{{ trans('Backstage') }}</a>
                    </li>
                @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ trans('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
