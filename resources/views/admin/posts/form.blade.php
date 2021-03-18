<form action="{{route('posts.store')}}" method="POST"  enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="user_id" value="{{$customer->id}}">

    <div class="form-group">
        Poszt tartalom:
        <textarea cols="10" rows="15" name="content" class="form-control">{{old('content')}}</textarea>
        @if($errors->first('content'))
            <p style="color:red">
                {{$errors->first('content')}}
            </p>
        @endif
    </div>

    <div class="form-group">
        Publikálás dátuma:
        <input type="date" name="public_at" value="{{old('public_at')}}">
    </div>

    <div class="form-group">
        Címkék:
        <br>
        <select name="tags[]" multiple>
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="submit" value="Mentés" class="btn btn-primary">
    </div>

</form>
