@extends('layouts.app')

@section('content')
    <cart
        action-route="{{route('cartCheckout')}}"
        products="{{$products}}"
        saved_addresses="{{$addresses}}"
        products_list_url="{{route('productsList')}}"
    >
    </cart>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
