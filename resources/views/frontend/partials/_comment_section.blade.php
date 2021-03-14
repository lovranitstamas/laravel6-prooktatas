@if(authCustomer())
    <form action="{{route('posts.comment.store',
                        ["type" => get_class($object) ,
                          "id"  => $object->id]
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
@foreach($object->comments()->orderBy('created_at','desc')->get() as $comment)
    <p>{{$comment->customer->name}} - {{$comment->created_at->format('Y-m-d H:i:s')}}</p>
    <p>
        {{$comment->content}}
    </p>
    <hr>
@endforeach
