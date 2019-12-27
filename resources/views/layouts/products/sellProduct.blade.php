@extends('layouts.app')

@section('content')
{{--{{dd($categories)}}--}}
    <sell-product action-route="{{route('addItem')}}" categories="{{$categories}}"></sell-product>
@endsection
