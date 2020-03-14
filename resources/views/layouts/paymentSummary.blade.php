@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="h1">Dziękujęmy za zakup!</p>
        @if($success)
            <p class="h2">Status: OK</p>
        @else
            <p class="h2">Status: ERROR</p>
        @endif
{{--        {{$payment}}--}}
{{--        {{$order}}--}}
    </div>
@endsection
