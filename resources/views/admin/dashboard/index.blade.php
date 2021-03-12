@extends('admin.layout.admin-layout')

@section('content')

    <h1>Hello: {{auth('admin')->user()->name}}</h1>

    @if($errors->first('email'))
        <h2 style="color: red">{{$errors->first('email')}}</h2>
    @endif

    <form action="{{route('admin.logout')}}" method="POST">
        @csrf
        <div class="form-group">
            <button type="submit" class="btn btn-primary m-3">Kilépés</button>
        </div>
    </form>

@stop
