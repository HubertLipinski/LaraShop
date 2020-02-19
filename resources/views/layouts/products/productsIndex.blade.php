@extends('layouts.app')

@section('content')
    <div class="container-fluid products">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="col-md-8 offset-md-2 px-0">
                    <p class="h1 pt-5 py-5">Produkty</p>
{{--                    <nav aria-label="breadcrumb">--}}
{{--                        <ol class="breadcrumb product-breadcrumbs">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Library</a></li>--}}
{{--                            <li class="breadcrumb-item" aria-current="page">Produkty</li>--}}
{{--                            <li class="breadcrumb-item active" aria-current="page">Obuwie</li>--}}
{{--                        </ol>--}}
{{--                    </nav>--}}
                </div>
            </div>
            <div class="col-sm-12 col-md-2">
                <div class="d-sm-block d-md-flex justify-content-sm-center justify-content-md-center py-sm-3 py-1 m-auto">
                    <nav class="nav flex-md-column product-menu">
                        <p class="h2 normal w-100 pl-sm-3 p-md-1 text-sm-center text-md-left">Menu</p>
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
            </div>
            <div class="col-sm-12 col-md-9 px-3 py-1">
                <div class="items-container m-auto">
                    @foreach($products as $item)

                    <div class="item p-2 m-3 border-0">
                        <div class="item-photos pt-2 pb-1">
                            <div id="item_{{$item->id}}" class="carousel slide" data-ride="false" data-interval="false">
                                <ol class="carousel-indicators">
                                    @for($i = 0; $i < count(json_decode($item->thumbnail)); $i++)
                                            <li data-target="#item_{{$item->id}}" data-slide-to="{{$i}}" class="item-indicator @if($i==0) active @endif"></li>
                                        @endfor
                                </ol>
                                <div class="carousel-inner">
                                    @for($i = 0; $i < count(json_decode($item->thumbnail)); $i++)
                                        <div class="carousel-item @if($i==0) active @endif">
                                            <img src="{{route('getImages', [$item->id, $i])}}" alt="Card image cap">
                                        </div>
                                    @endfor
                                </div>
                                <a class="carousel-control-prev" href="#item_{{$item->id}}" role="button" data-slide="prev">
                                    <span class="icon-left-arrow" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#item_{{$item->id}}" role="button" data-slide="next">
                                    <span class="icon-right-arrow" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="item-body">
                            <p class="h4 card-title mt-1 pt-3 text-truncate">Tytuł</p>
                            <p class="item-text p-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pharetra mauris id neque convallis feugiat. Sed sodales, magna ut malesuada pretium, eros arcu scelerisque velit, et convallis nunc augue id lectus. In accumsan lacinia maximus. Nunc dapibus blandit felis, vel mollis augue iaculis a. Nullam mattis neque a mauris bibendum rutrum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse eu venenatis felis. Aliquam suscipit quam tortor, at lacinia est bibendum et. Nullam pretium quis sem sit amet elementum. Curabitur at fermentum purus. Etiam auctor mattis mi, ut tincidunt dolor ultricies sed. Nullam sed mattis mauris. Proin cursus at tellus non dictum.
                            </p>
                            <div class="item-price text-right">
                                <p class="h5 text-muted"><s>550 zł</s></p>
                                <p class="h3">250 zł</p>
                            </div>
                            <div class="row pb-2">
                                <div class="col-3 d-flex align-items-center">
                                    <a href="#" class="btn btn-block p-2 favourite"></a>
                                </div>
                                <div class="col-9">
                                    <a href="{{route('showProduct', $item->id)}}" class="btn btn-block btn-outline-primary w-50 ml-auto">Zobacz więcej</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <nav class="d-flex justify-content-center">
                    {{$products->links()}}
                </nav>
            </div>
        </div>
    </div>
@endsection
