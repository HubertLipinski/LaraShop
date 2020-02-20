@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="h1">Twój koszyk</p>
        <div class="container py-2">
            <table class="table table-borderless table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Produkt</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena razem</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <img class="cart-image" src="{{route('getImages', [$product->id, 0])}}" alt="Card image cap">
                    </td>
                    <td >{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>ilosc</td>
                    <td>razem</td>
                    <td>delete</td>
                </tr>
                <tr>

                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry the Bird</td>
                    <td>@twitter</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
