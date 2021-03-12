@extends('frontend.layout.application')


@section('content')

    <h1>Kezdőlap</h1>
    <h3>Test register without ab</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('test.register')}}" method="POST">
        <!--<input type="hidden" name="_method" value="delete">-->
        @csrf
        Név:
        <input type="text" name="name" value="{{old('name')}}">
        @if($errors->first('name'))
            <p style="color:red">
                {{$errors->first('name')}}
            </p>
        @endif
        <br>
        Jelszó:
        <input type="password" name="password">
        @if($errors->first('password'))
            <p style="color:red">
                {{$errors->first('password')}}
            </p>
        @endif
        <br>
        Jelszó újra:
        <input type="password" name="password_confirmation">
        <br>
        <input type="submit" value="Register">
    </form>

    @if($i==3)
        Az $i értéke: {{$i}}
    @else
        Az $i értéke: {{$i}}
    @endif
@endsection


@section('footer')
    <footer>
        Footer
    </footer>
@endsection
