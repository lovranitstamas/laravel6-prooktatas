@extends('admin.layout.admin-layout')

@section('content')

    <h4>Jegyzetek</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <td>#</td>
            <td>Ügyfél e-mail címe</td>
            <td>Ügyfél</td>
            <td>Jegyzet tartalom</td>
            <td>Létrehozás dátuma</td>
            <td>Utolsó modosítás dátuma dátuma</td>
            <td>Módosítás</td>
            <td>Megtekintés</td>
        </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)
            <tr>
                <td>{{$note->id}}</td>
                <td>{{$note->customer->email}}</td>
                <td>{{$note->customer->name}} | {{$note->getCustomerName()}} </td>
                <td>{{$note->content}}</td>
                <td>{{$note->created_at->format('Y-m-d H:i:s')}}</td>
                <td>{{$note->updated_at}}</td>
                <td><a href="{{route('admin.posts.edit', ['postId' => $note->id])}}">Módosítás</a></td>
                <td><a href="{{route('admin.posts.show', ['postId' => $note->id])}}">Megtekintés</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection {{-- @stop--}}

@section('footer')
    <footer>
        Footer
    </footer>
@endsection
