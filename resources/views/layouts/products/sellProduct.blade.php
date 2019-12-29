@extends('layouts.app')

@section('content')
    <sell-product action-route="{{route('addItem')}}" categories="{{$categories}}"></sell-product>
@endsection
