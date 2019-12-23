@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="landing start" id="start">
            <div class="col-md-6 d-flex justify-content-center align-items-center landing-text">
                <div class="text-center" id="text">
                    <p class="h1 display-4">Kup lub sprzedaj</p>
                    <p class="h3 font-weight-normal pb-2">nieużywane przedmioty</p>
                    <div class="row no-gutters-p-0 my-4">
                        <div class="col-6 text-left">
                            <a href="#products" role="button" class="btn btn-lg btn-outline-primary btn-block py-3 btn-prod">Produkty</a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#" role="button" class="btn btn-lg btn-danger btn-block py-3 btn-sprz">Sprzedawaj</a>
                        </div>
                    </div>
                </div>
            </div>
            <img class="landing-cart img-fluid d-none d-md-block" id="cart" src="{{asset('img/landingcart.png')}}" alt="">
            <img class="landing-bottom img-fluid d-none d-md-block" src="{{asset('img/landing_curve_bottom_short.svg')}}" alt="">
        </div>
        <div class="products d-flex flex-column" id="products">
            <p class="h2 display-4 py-3 align-self-center section-header">Produkty</p>
            <div class="container d-flex align-items-center mt-3">
                <div class="col-md-4">
                    <nav class="w-50 nav flex-column product-menu m-auto">
                        <a class="nav-link active" href="#">Elektronika</a>
                        <a class="nav-link" href="#">Dom i ogród</a>
                        <a class="nav-link" href="#">Zdrowie</a>
                        <a class="nav-link" href="#">Gadżety</a>
                        <a class="nav-link" href="#">Motoryzacja</a>
                        <a class="nav-link" href="#">Zabawki</a>
                        <a class="nav-link" href="#">Książki</a>
                        <a class="nav-link" href="#">Gry</a>
                        <a class="nav-link" href="#">Filmy</a>
                    </nav>
                </div>
                <div class="col-md-4 mr-4">
                    <div class="row p-0 m-0">
                        <div class="col py-4 product-item-double overflow-hidden">
                            <a class="clear-link" href="#">
                                <span class="badge-best">Promocja</span>
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <img src="{{asset('img/items/view_1.jpg')}}" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <p class="m-0 text-muted">Audio</p>
                                        <p class="h2 m-0">Słuchawki</p>
                                        <div class="price py-2">
                                            <p class="h5 text-muted"><del>150 zł</del></p>
                                            <p class="h1">89 zł</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="w-100 mb-4"></div>
                        <div class="col product-item mr-4">
                            <a class="clear-link" href="#">
                                <div class="product text-center">
                                    <img class="img-fluid py-2" src="{{asset('img/items/new_3.jpg')}}" alt="">
                                    <div class="py-2">
                                        <div class="price py-2">
                                            <p class="h5 m-0">Xiaomi Band</p>
                                            <p class="h4 pt-2">120zł</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col product-item">
                            <div class="product text-center">
                                <a class="clear-link" href="#">
                                    <img class="img-fluid py-2" src="{{asset('img/items/view_4.jpg')}}" alt="">
                                    <div class="py-2">
                                        <div class="price py-2">
                                            <p class="h5 m-0">Samsung A5</p>
                                            <p class="h4 pt-2">850zł</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col product-item mr-4">
                            <a class="clear-link" href="#">
                                <div class="product text-center">
                                    <img class="img-fluid py-2" src="{{asset('img/items/trends_2.jpg')}}" alt="">
                                    <div class="py-2">
                                        <div class="price py-2">
                                            <p class="h5 m-0">Opaski fitness</p>
                                            <p class="h4 pt-2">450zł</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col product-item">
                            <a class="clear-link" href="#">
                                <div class="product text-center">
                                    <img class="img-fluid py-2" src="{{asset('img/items/view_5.jpg')}}" alt="">
                                    <div class="py-2">
                                        <div class="price py-2">
                                            <p class="h5 m-0">Playstation 4</p>
                                            <p class="h4 pt-2">890zł</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="w-100 mb-4"></div>
                        <div class="col py-4 overflow-hidden">
                                <div class="row py-2">
                                    <div class="col-12">
                                        <label class="h2 py-2" for="email">
                                           Zapisz się na newsletter i zgarnij 20% zniżki!
                                        </label>
                                        <form class="form-inline py-3">
                                            <div class="w-100 p-0 m-0">
                                                <input type="text" class="form-control" id="email" placeholder="E-mail">
                                                <button type="submit" class="btn btn-outline-primary">Wyślij</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#products" role="button" class="btn btn-lg btn-outline-primary my-3 py-3 product-more align-self-center">Zobacz więcej</a>
        </div>
        <div class="sell" id="sell">
            <div class="d-flex flex-column text-center">
                <p class="h2 display-4 py-3 align-self-center section-header">Sprzedaj</p>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/landing.js')}}"></script>
@endsection
