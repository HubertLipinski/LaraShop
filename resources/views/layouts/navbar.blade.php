<nav class="navbar navbar-expand-lg navbar-light transparent p-0 fixed-top fixed-navbar">
    <img class="landing-left img-fluid" src="{{asset('img/landing_curve_left_top.svg')}}" alt="">
    <a class="navbar-brand p-0" href="{{url('/')}}">
        <img class="p-3 p-sm-5 pr-0 logo img-fluid" src="{{asset('img/logo.png')}}" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav pr-5 ml-auto">
            @if(!Request::is('login', 'register'))
                <li class="nav-item px-1">
                    <a class="nav-link px-3" href="#start">Start</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link px-3" href="#items">Przedmioty</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link px-3" href="#sell">Sprzedaj</a>
                </li>
            @else
                <li class="nav-item px-1">
                    <a class="nav-link px-3" href="{{url('/')}}">Start</a>
                </li>
            @endif
            @guest
                <li class="nav-item px-1 @if(Request::is('login')) {{'active'}} @endif">
                    <a class="nav-link px-3" href="{{route('login')}}">Logowanie</a>
                </li>
                <li class="nav-item px-1 @if(Request::is('register')) {{'active'}} @endif">
                    <a class="nav-link px-3" href="{{route('register')}}">Rejestracja</a>
                </li>
            @endguest
            @auth
                    <li class="nav-item dropdown px-1">
                        <a class="nav-link px-3 dropdown-toggle" type="button" id="profileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="pr-2 user-icon"></i>Test1234
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileMenu">
                            <a class="dropdown-item" href="#">Profil</a>
                            <a class="dropdown-item" href="#">Wiadomości</a>
                            <a class="dropdown-item" href="#">Moje przedmioty</a>
                            <a class="dropdown-item" href="#">Kupione</a>
                            <a class="dropdown-item" href="#">Ustawienia</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Wyloguj się</a>
                        </div>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            @endauth
        </ul>
    </div>
</nav>
