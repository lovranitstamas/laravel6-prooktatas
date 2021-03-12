@extends('frontend.layout.application')

@section('content')

    <h4>Regisztráció</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @else
        @include('frontend.customers.form')
    @endif
@stop