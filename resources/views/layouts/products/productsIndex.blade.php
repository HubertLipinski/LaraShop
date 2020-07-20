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
                        @foreach($categories as $category)
                            <a class="nav-link {{(app('request')->request->get('category')) === $category->name ? 'active' : ''}}"
                               href="{{route('withCategory', $category->name)}}"
                            >
                                {{$category->name}}
                            </a>
                        @endforeach
                    </nav>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 px-3 py-1">
                <div class="items-container m-auto">
                    @if(!count($products))
                            <p class="h3 mr-auto py-3">Brak produktów</p>
                        @endif
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
                                            <img src="{{json_decode($item->thumbnail)[$i]}}" alt="image for product">
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
                            <p class="h4 card-title mt-1 pt-3 text-truncate">{{$item->name}}</p>
                            <p class="item-text p-0">
                                {{$item->description}}
                            </p>
                            <div class="item-price text-right">
{{--                                <p class="h5 text-muted"><s>550 zł</s></p>--}}
                                <p class="h3">Cena: {{$item->price}} zł</p>
                            </div>
                            <div class="row pb-2">
                                <div class="col-3 d-flex align-items-center">
                                    <fav-add
                                        :id="{{$item->id}}"
                                        isfavourite="@guest 0 @endguest
                                        @auth {{Auth::user()->hasFavourite($item->id)}} @endauth"
                                        store="{{route('favourite.store')}}"
                                        delete="{{route('favourite.destroy', $item->id)}}"
                                    >
                                    </fav-add>
                                </div>
                                <div class="col-9 d-flex justify-content-center align-items-center">
                                    <cart-add
                                        :id="{{$item->id}}"
                                        cart_url="{{route('cart')}}"
                                    >
                                    </cart-add>
                                    <a href="{{route('showProduct', $item->id)}}" class="btn btn-outline-primary w-50">Zobacz więcej</a>
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
