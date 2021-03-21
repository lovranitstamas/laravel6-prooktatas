@extends('admin.layout.admin-layout')

@section('content')

    <h4>Jegyzet létrehozása</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @else
        @include('admin.posts.form')
    @endif
@stop
