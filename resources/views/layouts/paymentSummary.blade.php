@extends('layouts.app')

@section('content')

    <div class="container pb-5">
        @if($success)
            <p class="h1 text-center py-3">Dziękujemy za zakup!</p>
            <div class="p-3">
                <p class="h2">Zamówienie nr #{{$order->id}}</p>
                <div class="pl-3">
                    <p class="h4">Dane: </p>
                    <p class="m-0 pb-1">
                        <span class="font-weight-bold">Status płatności: </span>
                        {{$payment->order_status}}
                    </p>
                    <p class="m-0">
                        <span class="font-weight-bold">Identyfikator płatności: </span>
                        {{$payment->payment_provider_order_id}}
                    </p>
                    <p class="m-0 pt-1">
                        <span class="font-weight-bold">Czas: </span>
                        {{$payment->created_at}}
                    </p>
                </div>

                <div class="py-3">
                    <p class="h4 pt-2">Adres dostawy: </p>
                    <div class="pl-3">
                        <p class="m-1"><b>Imie: </b> {{$order->address->name}} </p>
                        <p class="m-1"><b>Nazwisko: </b> {{$order->address->surname}}</p>
                        <p class="m-1"><b>Adres: </b> {{$order->address->address}} </p>
                        <p class="m-1"><b>Kod pocztowy: </b> {{$order->address->zip_code}} </p>
                        <p class="m-1"><b>Miasto: </b> {{$order->address->city}}</p>
                        <p class="m-1"><b>Kraj: </b> {{$order->address->country}}</p>
                        <p class="m-1"><b>Nr. Telefonu: </b> +{{$order->address->number}} </p>
                    </div>
                </div>

                <p class="h4 py-4">Kupione przedmioty: </p>
                <table class="table table-sm table-borderless text-center">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->cart->items()->get() as $item)
                        <tr>
                            <td class="align-middle">
                                <div class="cart-image">
                                    <img class="rounded img-fluid" src="{{json_decode($item->thumbnail)[0]}}" alt="cart item">
                                </div>
                            </td>
                            <td class="align-middle">{{$item->name}}</td>
                            <td class="align-middle">{{$item->pivot->qty}} szt.</td>
                            <td class="align-middle">{{$item->price}} zł</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="align-middle pt-5" colspan="2"></td>
                        <td class="align-middle pt-5" colspan="2">
                            <p class="m-0">
                                <span class="font-weight-bold">Kupon rabatowy: </span>
                                <span class="h5">{{$order->cart->coupon ? $order->cart->coupon : 'Brak'}}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle" colspan="2"></td>
                        <td class="align-middle" colspan="2">
                            <p class="m-0">
                                <span class="font-weight-bold">Razem łącznie: </span>
                                <span class="h5">{{$order->value}} zł </span>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{route('user.items')}}" class="btn btn-lg btn-block w-25 btn-outline-primary btn-prod py-2 ml-auto">Dalej</a>
        @else
            <p class="h1 text-center py-3">Coś poszło nie tak...</p>
            <div class="p-3">
                <p class="h2">Zamówienie nr #{{$order->id}}</p>
                <div class="pl-3">
                    <p class="text-danger h2">Nie udało się przetworzyć płatności</p>
                    <p class="m-0 pb-1">
                        <span class="font-weight-bold">Kod błędu: </span>
                        {{$code}}
                    </p>
                    <p class="m-0 pb-1">
                        <span class="font-weight-bold">Status płatności: </span>
                        {{$payment->order_status}}
                    </p>
                    <p class="m-0 ">
                        <span class="font-weight-bold">Identyfikator płatności: </span>
                        {{$payment->payment_provider_order_id}}
                    </p>
                    <p class="m-0">
                        <span class="font-weight-bold">Czas: </span>
                        {{$payment->created_at}}
                    </p>
                </div>
                <a href="{{route('user.items')}}" class="btn btn-block w-25 btn-outline-danger btn-prod py-2 ml-auto">Dalej</a>
            </div>
        @endif
    </div>
@endsection
