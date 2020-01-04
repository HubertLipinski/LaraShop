@extends('layouts.app')

@section('content')
    <sell-product action-route="{{route('addItem')}}" categories="{{$categories}}"></sell-product>
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
