@extends('layouts.app')

@section('content')
    <cart
        action-route="{{route('cartCheckout')}}"
        products="{{$products}}"
        saved_addresses="{{}}"
    >
    </cart>

@endsection
