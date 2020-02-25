@extends('layouts.app')

@section('content')
{{--    {{dd(json_decode($product->thumbnail)[0])}}--}}
    <div class="container">
        <nav aria-label="breadcrumb" class="m-auto ">
            <ol class="breadcrumb product-breadcrumbs px-0 text-left">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Start</a></li>
                <li class="breadcrumb-item"><a href="{{route('productsList')}}">Produkty</a></li>
                <li class="breadcrumb-item"><a href="#">{{$categories[0]}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
            </ol>
        </nav>
        <p class="h1">{{$product->name}}</p>
        <p class="h6 text-muted pt-1">
            {{implode(' · ', $categories)}}
        </p>
        <div class="row py-3">
            <div class="col-md-6 text-center single-product">
                <img src="{{route('getImages', [$product->id, 0])}}" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <p class="lead">Opis produktu:</p>
                <p>{{$product->description}}</p>

                <div class="item-body pt-5">
                    <div class="item-price text-right">
                        <p class="h5 text-muted"><s>550 zł</s></p>
                        <p class="h3">250 zł</p>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-end mt-2">
                            <a href="#" class="btn btn-block favourite w-25 p-2 mr-3"></a>
                            <a href="#" class="btn btn-block btn-outline-primary mt-0 w-50 ml-auto d-none">Dodaj do koszyka</a>
{{--                            <a href="#" class="btn btn-block btn-danger mt-0 w-50 ml-3">Kup teraz</a>--}}
                            <form class="w-100 m-auto" method="POST" action="{{route('addToCart')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <button type="submit" class="btn btn-block btn-danger mt-0 w-50 ml-3 ml-auto">Dodaj do koszyka</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
