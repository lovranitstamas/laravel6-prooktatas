<form action="{{$customer->id ? route('customers.update', $customer->id) : route('customers.store')}}" method="POST">
    @if($customer->id)
        <input type="hidden" name="_method" value="PUT">{{--PATCH--}}

        <div class="form-group">
            #:
            <input type="text" name="id" value="{{$customer->id}}" disabled class="form-control">
        </div>
    @endif

    @csrf

    <div class="form-group">
        Név:
        <input type="text" name="name" value="{{old('name') ?: $customer->name}}"
               class="{{$errors->first('name') ? 'has-error': ''}} form-control">
        @if($errors->first('name'))
            <p style="color:red">
                {{$errors->first('name')}}
            </p>
        @endif
    </div>

    <div class="form-group">
        Email:
        <input type="text" name="email" value="{{old('email') ?: $customer->email}}" class="form-control">
        @if($errors->first('email'))
            <p style="color:red">
                {{$errors->first('email')}}
            </p>
        @endif
    </div>

    <div class="form-group">
        Leírás:
        <input type="text" name="description" value="{{old('description') ?: $customer->description}}" class="form-control">
        @if($errors->first('description'))
            <p style="color:red">
                {{$errors->first('description')}}
            </p>
        @endif
    </div>

    <div class="form-group">
        Jelszó:
        <input type="password" name="password" class="form-control">
        @if($errors->first('password'))
            <p style="color:red">
                {{$errors->first('password')}}
            </p>
        @endif
    </div>

    <div class="form-group">
        Jelszó újra:
        <input type="password" name="password_confirmation" class="form-control">
    </div>


    @if(!$customer->id)
        <div class="form-group">
            <label>
                <input type="checkbox" name="terms" value="1" {{old('terms') ? 'checked': ''}}>
                Elfogadok mindent
            </label>
            @if($errors->first('terms'))
                <p style="color:red">
                    {{$errors->first('terms')}}
                </p>
            @endif
        </div>
    @endif

    <div class="form-group">
        <input type="submit" value="{{!$customer->id ? 'Register' : 'Modify'}}" class="btn btn-primary">
    </div>

</form>
