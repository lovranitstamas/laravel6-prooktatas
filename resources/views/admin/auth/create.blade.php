@extends('admin.layout.admin-layout')

@section('content')


    <h4>Belépés</h4>
    <form action="{{route('admin.login.store')}}" method="POST">
        @csrf
        <div class="form-group">
            Email:
            <input type="text" name="email" value="{{old('email')}}" class="form-control">
        </div>

        <div class="form-group">
            Password:
            <input type="password" name="password" class="form-control">
            <br><br>
            <button type="submit" class="btn btn-primary">Belépés</button>
        </div>
    </form>

@stop
