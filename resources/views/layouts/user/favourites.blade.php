@extends('layouts.app')

@section('content')
    <div class="container">
       <p class="h3">Moje ulubione</p>
        <div class="d-flex align-items-stretch align-content-around flex-wrap">
            @foreach($favourite as $item)
                <user-favourite-card
                    :product="{{$item}}"
                    view_route="{{route('showProduct', $item->id)}}"
                    delete="{{route('favourite.destroy', $item->id)}}"
                ></user-favourite-card>
            @endforeach

        </div>

    </div>
@endsection
