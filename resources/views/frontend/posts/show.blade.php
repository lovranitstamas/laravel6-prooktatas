@extends('frontend.layout.application')

@section('content')

    <h2>Poszt címe: {{$note->title}}</h2>
    <h4>Poszt írója: {{$note->customer->name}}</h4>
    <p>Címkék: {{implode(',',$note->tags()->pluck('name')->toArray())}}</p>
    <p>
        @foreach($note->tags as $tag)
            <a href="{{route('posts.index', ['search' => ['tag_id'=>$tag->id]])}}">{{$tag->name}}</a>
        @endforeach
    </p>

    <p>
        Poszt tartalma: {{$note->content}}
    </p>

    @include('frontend.partials._comment_section', ['object'=> $note])

    {{--<hr>
    @if(authCustomer())
        <form action="{{route('posts.comment.store',
                        ["type" => get_class($note) ,
                          "id"  => $note->id]
                        )}}" method="POST">
            @csrf
            <div class="form-group">
                Komment
                <textarea name="content" class="form-control" cols="10" rows="5"></textarea>
                @if($errors->first('content'))
                    <p style="color:red">
                        {{$errors->first('content')}}
                    </p>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Küldés</button>
            </div>
        </form>

        @if(session()->has('message'))
            <h4>{{session('message')}}</h4>
        @endif

    @else
        <p>Hozzászólás írásához jelentkezzen be</p>
    @endif

    <hr>
    @foreach($note->comments()->orderBy('created_at','desc')->get() as $comment)
        <p>{{$comment->customer->name}} - {{$comment->created_at->format('Y-m-d H:i:s')}}</p>
        <p>
            {{$comment->content}}
        </p>
        <hr>
    @endforeach--}}

@stop()
