@extends('admin.layout.admin-layout')

@section('content')

    <h1>Hello admin: {{auth('admin')->user()->name}}</h1>

    @if($errors->first('email'))
        <h2 style="color: red">{{$errors->first('email')}}</h2>
    @endif
    <form action="{{route('admin.logout')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary m-3">Kilépés</button>
    </form>

@stop