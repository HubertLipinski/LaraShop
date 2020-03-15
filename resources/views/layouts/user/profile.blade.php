@extends('layouts.app')

@section('content')
    <div class="container">
       <p class="h2">Mój profil</p>

        <div class="row text-center pt-5">
            <div class="col-md-2 text-center">
                <img class="img-fluid" src="{{$user->getAvatar()}}" alt="User avatar">
                <p class="text-mutted py-2">Zmień</p>
            </div>
            <div class="col-md-3">
                <span class="font-weight-bold">Imie: </span> <p>{{$user->name}}</p>
                <span class="font-weight-bold">Nazwisko: </span> <p>{{$user->name}}</p>
                <span class="font-weight-bold">Email: </span> <p>{{$user->email}}</p>
            </div>
            <div class="col-md-3">
                <span class="font-weight-bold">Hasło: </span> <p>**********</p>
                <span class="font-weight-bold">Liczba adresów: </span> <p>{{count($addresses)}}</p>
                <span class="font-weight-bold">Liczba przedmiotów: </span> <p>{{$product_number}}</p>
            </div>
            <div class="col-md-3">
                <span class="font-weight-bold">Kupione przedmioty: </span> <p>{{$user->boughtItems()}}</p>
                <span class="font-weight-bold">Konto od: </span> <p>{{$user->created_at}}</p>
{{--                <span class="font-weight-bold">Email: </span> <p>{{$user->email}}</p>--}}
            </div>
            <div class="col-md-1">
                edytuj
            </div>
        </div>
        <p class="h3">Twoje zapisane adresy: </p>
        <saved-addresses
            :addresses="{{$addresses}}"
        ></saved-addresses>

    </div>
@endsection
