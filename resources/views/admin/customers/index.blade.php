@extends('admin.layout.admin-layout')

@section('content')

    <h4>Ügyfelek</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @endif


    <form action="{{route('admin.customers.index')}}" method="GET">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>{!! orderTableHeader('id', '#') !!}</td>
                <td>{!! orderTableHeader('name', 'Név') !!}</td>
                <td>{!! orderTableHeader('email', 'E-mail') !!}</td>
            </tr>
            <tr>
                <td><input type="text" name="search[name]" value="{{request()->input('search.name')}}"></td>
                <td colspan="9"></td>
                <td><input type="submit" value="keresés"></td>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr id="customer-{{$customer->id}}">
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>


@endsection {{-- @stop--}}

@section('footer')
    <footer>
        Footer
    </footer>
@endsection
