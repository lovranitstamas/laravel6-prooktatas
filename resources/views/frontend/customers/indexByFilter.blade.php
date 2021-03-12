@extends('frontend.layout.application')

@section('content')

    <h4>Ügyfelek</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @endif

    <form action="{{route('customers.indexByFilterDateResult')}}" method="GET">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>Név</td>
                <td>E-mail</td>
                <td>Utolsó modosítás dátuma dátuma</td>
                <td>Keresés</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="search[id]" value="{{request()->input('search.id')}}"></td>
                <td><input type="text" name="search[name]" value="{{request()->input('search.name')}}"></td>
                <td><input type="text" name="search[email]" value="{{request()->input('search.email')}}"></td>
                <td><input type="text" name="search[updated_at]" value="{{request()->input('search.updated_at')}}"></td>
                <td><input type="submit" value="Utolsó egy héten regisztráltak"></td>
            </tr>

            @foreach($customers as $customer)
                <tr id="customer-{{$customer->id}}">
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->lastUpdated()}}</td>
                    <td>
                        <button class="btn btn-danger del-button"
                                data-token="{{csrf_token()}}"
                                data-id="{{$customer->id}}"
                                data-url="{{route('customers.destroyDestroyWithJson', $customer->id)}}">
                            Törlés
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>

    <form action="{{route('customers.indexByFilterSearch')}}" method="GET">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>Név</td>
                <td>E-mail</td>
                <td>Utolsó modosítás dátuma dátuma</td>
                <td>Keresés</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="search[id]" value="{{request()->input('search.id')}}"></td>
                <td><input type="text" name="search[name]" value="{{request()->input('search.name')}}"></td>
                <td><input type="text" name="search[email]" value="{{request()->input('search.email')}}"></td>
                <td><input type="text" name="search[updated_at]" value="{{request()->input('search.updated_at')}}"></td>
                <td><input type="submit" value="Szűrés"></td>
            </tr>

            @foreach($customers as $customer)
                <tr id="customer-{{$customer->id}}">
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->lastUpdated()}}</td>
                    <td>
                        <button class="btn btn-danger del-button"
                                data-token="{{csrf_token()}}"
                                data-id="{{$customer->id}}"
                                data-url="{{route('customers.destroyDestroyWithJson', $customer->id)}}">
                            Törlés
                        </button>
                    </td>
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
