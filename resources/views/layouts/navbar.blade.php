<nav class="navbar navbar-expand-lg navbar-light transparent p-0 fixed-top fixed-navbar">
    <img class="landing-left img-fluid" src="{{asset('img/landing_curve_left_top.svg')}}" alt="">
    <a class="navbar-brand p-0 w-50" href="{{url('/')}}">
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
                    <a class="nav-link px-3" href="#products">Produkty</a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link px-3" href="#sell">Sprzedaj</a>
                </li>
            @else
                <li class="nav-item px-1">
                    <a class="nav-link px-3" href="{{url('/')}}">Start</a>
                </li>
            @endif
            <li class="nav-item px-1 @if(Request::is('login')) {{'active'}} @endif">
                <a class="nav-link px-3" href="{{route('login')}}">Logowanie</a>
            </li>
            <li class="nav-item px-1 @if(Request::is('register')) {{'active'}} @endif">
                <a class="nav-link px-3" href="{{route('register')}}">Rejestracja</a>
            </li>
        </ul>
    </div>
</nav>
