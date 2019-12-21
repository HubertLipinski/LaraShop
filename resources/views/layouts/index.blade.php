@extends('layouts.app')
    <div class="container-fluid">
        <div class="landing">
            <nav class="navbar navbar-expand-lg navbar-light transparent p-0 fixed-top">
                <img class="landing-left img-fluid" src="{{asset('img/landing_curve_left_top.svg')}}" alt="">
                <a class="navbar-brand p-0 w-50" href="#">
                    <img class="p-3 p-sm-5 pr-0 logo img-fluid" src="{{asset('img/logo.png')}}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav pr-5 ml-auto">
                        <li class="nav-item px-1 active">
                            <a class="nav-link px-3" href="#">Start</a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link px-3" href="#">Produkty</a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link px-3" href="#">Sprzedaj</a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link px-3" href="#">Logowanie</a>
                        </li>
                        <li class="nav-item px-1">
                            <a class="nav-link px-3" href="#">Rejestracja</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-md-6 d-flex justify-content-center align-items-center landing-text">
                <div class="text-center" id="text">
                    <p class="h1 display-4">Kup lub sprzedaj</p>
                    <p class="h3 font-weight-normal pb-2">nieużywane przedmioty</p>
                    <div class="row no-gutters-p-0 my-4">
                        <div class="col-6 text-left">
                            <button type="button" class="btn btn-lg btn-outline-primary btn-block py-3 btn-prod">Produkty</button>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-lg btn-danger btn-block py-3 btn-sprz">Sprzedawaj</button>
                        </div>
                    </div>
                </div>
            </div>
            <img class="landing-cart img-fluid d-none d-md-block" id="cart" src="{{asset('img/landingcart.png')}}" alt="">
            <img class="landing-bottom img-fluid d-none d-md-block" src="{{asset('img/landing_curve_bottom_short.svg')}}" alt="">
        </div>
    </div>


{{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}
<script>

    window.addEventListener('scroll', function(e) {

        let pos = window.scrollY;
        let offset = pos * 3.5;
        const text = document.getElementById('text');
        const cart = document.getElementById('cart');

        let fade;
        (pos <= 0)
            ? fade = 1
            : fade = parseFloat((20/offset).toFixed(1));

        text.style.transform = 'translate3d(-'+offset+'px,'+offset/4+'px,0px)';
        cart.style.transform = 'translate3d('+offset+'px,'+offset/4+'px,0px)';
        cart.style.opacity = fade;
    });
</script>
