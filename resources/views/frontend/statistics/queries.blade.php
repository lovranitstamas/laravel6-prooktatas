@extends('frontend.layout.application')

@section('content')

    <h4>Statisztikai adatok</h4>

    @isset($lastThreeCustomer)
        <p>Legutóbb kommentelő 3 ügyfél</p>
        <ul>
            @foreach($lastThreeCustomer as $comment)
                <li>{{$comment->customer->name}} - {{$comment->content}} - {{$comment->created_at}}</li>
            @endforeach
        </ul>
    @endisset

    @isset($mostCommentingCustomer)
        <p>A legtöbbet kommentelő</p>
        <br>Név: {{$mostCommentingCustomer->customer->name}}
        <br>Leadott kommentek száma: {{$mostCommentingCustomer->sum}}
    @endisset

    @isset($customerReceivedMostComments)
        <p>Az az ügyfél, aki a legtöbb kommentet kapta</p>
        <br>Név: {{$customerReceivedMostComments->note->customer->name}}
        <br>Kapott kommentek száma: {{$customerReceivedMostComments->sum}}
    @endisset

    @isset($mostCommentedNote)
        <p>Legtöbbet kommentelt jegyzet</p>
        <br>Tartalom: {{$mostCommentedNote->note->content}}
        <br>Létrehozás dátuma: {{$mostCommentedNote->note->created_at}}
        <br>Kommentek száma: {{$mostCommentedNote->sum}}
    @endisset

    @isset($searchedNote)
        <p>A legtöbb kommentelt tag</p>
        <ul>
            @foreach($searchedNote->tags as $tag)
                <li>{{$tag->name}}</li>
            @endforeach
        </ul>
    @endisset


@endsection {{-- @stop--}}

@section('footer')
    <footer>
        Footer
    </footer>
@endsection
