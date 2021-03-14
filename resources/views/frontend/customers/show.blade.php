@extends('frontend.layout.application')

@section('content')

    <h4>Megtekintés</h4>

    <div class="form-group">
        Név:
        <input type="text" name="name" value="{{$customer->name}}" disabled class="form-control">
    </div>

    <div class="form-group">
        Email:
        <input type="text" name="email" value="{{$customer->email}}" disabled class="form-control">
    </div>

    <div class="form-group">
        Leírás:
        <input type="text" name="description" value="{{$customer->description}}" disabled class="form-control">
    </div>

    @include('frontend.partials._comment_section', ['object'=> $note])
@endsection

@section('footer')
    <footer>
        Footer
    </footer>
@endsection
