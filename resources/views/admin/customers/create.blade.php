@extends('admin.layout.admin-layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ügyfél létrehozása</h3>
                </div>
                <!-- /.box-header -->
                @include('admin.customers.form')
            </div>
        </div>
    </div>
@stop
