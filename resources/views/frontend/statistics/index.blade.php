@extends('frontend.layout.application')

@section('content')

    <h4>Statisztikai adatok</h4>

    <ul>
        <li><a href="{{route('statistics.lastThreeCustomer')}}">Legutóbb kommentelő 3 ügyfél</a></li>
        <li><a href="{{route('statistics.mostCommentingCustomer')}}">A legtöbbet kommentelő</a></li>
        <li><a href="{{route('statistics.customerReceivedMostComments')}}">Az az ügyfél, aki a legtöbb
                kommentet kapta</a></li>
        <li><a href="{{route('statistics.mostCommentedNote')}}">Legtöbbet kommentelt jegyzet</a></li>
        <li><a href="{{route('statistics.mostCommentedTag')}}">A legtöbbet kommentelt Tag</a></li>
    </ul>

@endsection {{-- @stop--}}

@section('footer')
    <footer>
        Footer
    </footer>
@endsection
