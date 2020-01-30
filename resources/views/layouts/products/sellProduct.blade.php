@extends('layouts.app')

@section('content')
    <sell-product action-route="{{route('addItem')}}" categories="{{$categories}}" errors="{{json_encode($errors->all())}}"></sell-product>
@endsection
