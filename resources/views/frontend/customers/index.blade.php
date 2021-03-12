@extends('frontend.layout.application')

@section('content')

    <h4>Ügyfelek</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @endif


    <form action="{{route('customers.index')}}" method="GET">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>#</td>
                <td>
                    {!! orderTableHeader('name', 'Név') !!}
                    {{--|
                    <a href="{{
                      route('customers.index', [
                        'orderBy' => 'name',
                        'orderDir' =>
                        request()->input('orderBy') == 'name' &&
                        request()->input('orderDir') == 'asc' ? 'desc': 'asc'
                      ])
                      }}">Név</a>--}}
                </td>
                <td>E-mail</td>
                <td>Leírás</td>
                <td>Regisztrációs dátuma</td>
                <td>Utolsó modosítás dátuma dátuma</td>
                <td>Megtekintés</td>
                <td>Módosítás</td>
                <td>Posztok száma</td>
                <td>Hagyományos törlés</td>
                <td>Json alapú törlés</td>
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
                    <td>{{$customer->description}}</td>
                    <td>{{$customer->created_at}}</td>
                    <td>{{$customer->lastUpdated()}}</td>
                    <td><a href="{{route('customers.show', ['id' => $customer->id])}}">Megtekintés</a></td>
                    <td><a href="{{route('customers.edit', ['id' => $customer->id])}}">Módosítás</a></td>
                    <td><a href="{{route('posts.index', $customer->id)}}">Posztok({{$customer->notes()->count()}})
                        </a></td>
                    <td>
                        <form action="{{route('customers.destroy', $customer->id)}}" method="POST">
                            <input type="hidden" name="_method" value="delete">
                            @csrf
                            <input type="submit" name="button" value="Törlés">
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-danger del-button"
                                id="not-own-posts"
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
