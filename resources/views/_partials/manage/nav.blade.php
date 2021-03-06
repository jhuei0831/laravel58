<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/manage') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ trans('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('navbar.index') }}">{{ trans('Navbar').trans('Manage') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu.index') }}">{{ trans('Menu').trans('Manage') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page.index') }}">{{ trans('Page').trans('Manage') }}</a>
                </li>
                @if (Auth::check() && Auth::user()->permission > '4')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member.index') }}">{{ trans('Member').trans('Manage') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('log.index') }}">{{ trans('Log') }}</a>
                </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ trans('Fontstage') }}</a>
                </li>
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
            </ul>
        </div>
    </div>
</nav>
