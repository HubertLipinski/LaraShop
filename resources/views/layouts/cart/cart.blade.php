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
                    <td class="align-middle">
                        <div class="cart-image">
                            <img class="rounded img-fluid" src="{{route('getImages', [$product->id, 0])}}" alt="Card image cap">
                        </div>
                    </td>
                    <td class="align-middle">{{$product->name}}</td>
                    <td class="align-middle">{{$product->price}} zł</td>
                    <td class="align-middle">
                        <div class="form-group cart-qty m-auto p-0 m-0">
                            <input type="number" class="form-control" min="1" id="exampleInputPassword1" placeholder="1">
                        </div>
                    </td>
                    <td class="align-middle">razem</td>
                    <td class="align-middle">
                        <button type="button" class="btn btn-outline-danger">
                            Usuń <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
                <hr/>
            </table>
            <hr/>
            <div>
                form z addresem
            </div>
            <div class="w-100 p-5 text-right">
                <p class="h5">Do zapłaty: 123 zł</p>
                kontynuuj
            </div>
        </div>
    </div>
@endsection
