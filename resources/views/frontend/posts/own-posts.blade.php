@extends('frontend.layout.application')

@section('content')

    <h4>Saját posztok</h4>

    @if(session()->has('message'))
        <h3>{{session('message')}}</h3>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <td>#</td>
            <td>Jegyzet tartalom</td>
            <td>Létrehozás dátuma</td>
            <td>Utolsó modosítás dátuma dátuma</td>
            <td>Módosítás</td>
            <td>Törlés</td>
        </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)
            <tr id="note-{{$note->id}}">
                <td>{{$note->id}}</td>
                <td>{{$note->content}}</td>
                <td>{{$note->created_at->format('Y-m-d H:i:s')}}</td>
                <td>{{$note->updated_at}}</td>
                <td><a href="{{route('posts.edit', ['postId' => $note->id])}}">Módosítás</a></td>
                <td>
                    <button class="btn btn-danger del-button"
                            id="own-posts"
                            data-token="{{csrf_token()}}"
                            data-target="#note-{{$note->id}}"
                            data-url="{{route('ownPosts.destroyDestroyWithJson', $note->id)}}">
                        Törlés
                    </button>
                </td>
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
