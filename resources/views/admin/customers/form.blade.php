<!-- form start -->
<form action="{{$customer->id ? route('admin.customers.update', $customer->id) : route('admin.customers.store')}}"
      method="POST">
    <div class="box-body">

        @if($customer->id)
            <input type="hidden" name="_method" value="PUT">{{--PATCH--}}

            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" value="{{$customer->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        <div class="form-group">
            <label for="name">Név:</label>
            <input type="text" name="name" id="name" value="{{old('name') ?: $customer->name}}"
                   class="{{$errors->first('name') ? 'has-error': ''}} form-control">
            @if($errors->first('name'))
                <p style="color:#ff0000">
                    {{$errors->first('name')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{old('email') ?: $customer->email}}"
                   class="form-control">
            @if($errors->first('email'))
                <p style="color:red">
                    {{$errors->first('email')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Leírás:</label>
            <input type="text" name="description" id="description" value="{{old('description') ?:
                $customer->description}}"
                   class="form-control">
            @if($errors->first('description'))
                <p style="color:red">
                    {{$errors->first('description')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Jelszó:</label>
            <input type="password" name="password" id="password" class="form-control">
            @if($errors->first('password'))
                <p style="color:red">
                    {{$errors->first('password')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation">Jelszó újra:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Profil kép</label>
            <input type="file" name="file" id="exampleInputFile">

            <p class="help-block">random help</p>
        </div>

        {{--<div class="checkbox">
            <label>
                <input type="checkbox"> Check me out
            </label>
        </div>--}}
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <input type="submit" value="{{!$customer->id ? 'Létrehozás' : 'Módosítás'}}" class="btn btn-primary">
    </div>
</form>

