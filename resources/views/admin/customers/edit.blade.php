@extends('admin.layout.admin-layout')

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @include('admin.customers.form')

@stop
