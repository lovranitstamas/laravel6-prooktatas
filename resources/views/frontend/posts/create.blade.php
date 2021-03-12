@extends('frontend.layout.application')

@section('content')

    <h4>Jegyzet Létrehozása</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @else
        @include('frontend.posts.form')
    @endif
@stop
