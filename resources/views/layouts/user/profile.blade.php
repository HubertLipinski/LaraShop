@extends('layouts.app')

@section('content')
    <div class="container">
       <p class="h2">Mój profil</p>

        <user-profile
            :user="{{$user->toJson()}}"
            :user_avatar="{{json_encode($user->getAvatar())}}"
            :product_number="{{$product_number}}"
            :items_bought="{{$items_bought}}"
            :address_number="{{count($addresses)}}"
        ></user-profile>

        <p class="h3">Twoje zapisane adresy: </p>
        <saved-addresses
            :addresses="{{$addresses}}"
        ></saved-addresses>

    </div>
@endsection
