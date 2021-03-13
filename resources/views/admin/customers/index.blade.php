@extends('admin.layout.admin-layout')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ügyfél lista</h3>
                    <div class="card-tools">
                        <a href="{{route('admin.customers.create')}}" class="nav-link">
                            <p>Ügyfél létrehozása</p>
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">


                    <form action="{{route('admin.customers.index')}}" method="GET">
                        <table class="table table-hover text-wrap">
                            <thead>
                            <tr>
                                <td>{!! orderTableHeader('id', '#') !!}</td>
                                <td>{!! orderTableHeader('name', 'Név') !!}</td>
                                <td>{!! orderTableHeader('email', 'E-mail') !!}</td>
                                <td>Módosítás</td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="search[name]" value="{{request()->input('search.name')
                }}"></td>
                                <td colspan="2"></td>
                                <td><input type="submit" class="btn btn-primary" value="keresés"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr id="customer-{{$customer->id}}">
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td><a class="btn btn-default" href="{{route('admin.customers.edit', ['id' => $customer->id])
                    }}">Módosítás <i
                                                class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection {{-- @stop--}}

@section('footer')
    <footer>
        Footer
    </footer>
@endsection
