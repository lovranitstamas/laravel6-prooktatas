<form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        Ügyfél:
        <select name="user_id" class="form-control">
            @foreach($customers as $customer)
                <option value="{{$customer->id}}"
                    {{old('customer_id') == $customer->id ? 'selected': ''}}
                >{{$customer->name}} ({{$customer->email}})
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        Poszt tartalom:
        <textarea cols="10" rows="15" name="content" class="form-control ckeditor"
        >{{old('content')}}</textarea>
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

@section('extra-scripts')
    <script src="{{asset('vendor/japonline/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('.ckeditor');
    </script>
@endsection
