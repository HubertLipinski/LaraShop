<nav class="navbar navbar-expand-lg navbar-light transparent p-0 fixed-navbar">
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
                    <a class="nav-link px-3 @if(Request::is('/')) {{'active'}} @endif" href="{{route('home')}}">Start</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link px-3 @if(Request::is('items*')) {{'active'}} @endif" href="{{route('productsList')}}">Przedmioty</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link px-3 @if(Request::is('sell')) {{'active'}} @endif" href="{{route('user.sell')}}">Sprzedaj</a>
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
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item px-1">
                            <a class="nav-link px-3" href="{{url('/admin')}}">Panel Admina</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown px-1">
                        <a class="nav-link px-3 dropdown-toggle" type="button" id="profileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="pr-2 user-icon"></i>{{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileMenu">
                            <a class="dropdown-item" href="{{route('user.profile')}}">Profil</a>
                            <a class="dropdown-item" href="{{route('user.messages')}}">Wiadomości <span class="font-weight-bold">(1)</span></a>
                            <a class="dropdown-item" href="{{route('user.items')}}">Moje przedmioty</a>
                            <a class="dropdown-item" href="#">Kupione</a>
                            <a class="dropdown-item" href="{{route('user.fav')}}">Ulubione</a>
                            <a class="dropdown-item" href="{{route('user.settings')}}">Ustawienia</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Wyloguj się</a>
                        </div>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <li class="nav-item @if(Request::is('cart')) {{'active'}} @endif">
                        <a class="nav-link d-block cart-button" href="{{route('cart')}}">
                            <i class="shopping-cart"></i>
                            @if(count(Auth::user()->cart->items) > 0)
                                <span class="badge badge-pill badge-primary align-text-bottom">{{Auth::user()->cart->items->count()}}</span>
                            @endif
                        </a>
                    </li>
            @endauth
        </ul>
    </div>
</nav>
