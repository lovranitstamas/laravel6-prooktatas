<a href="{{route('customers.index')}}">Ügyfelek listázása(3) </a> |
<a href="{{route('customers.indexByFilter')}}">Ügyfelek listázása szűrés alapján(4)</a> |
<a href="{{route('statistics')}}">Statisztika</a> |


{{--@if(!auth()->guard()->check())--}}
<a href="{{route('posts.index')}}">Publikált posztok (6)</a> |
@if(authCustomer())
    <a href="{{route('posts.ownPosts')}}">Posztok listája (saját) (6)</a> |
    <a href="{{route('posts.create')}}">Poszt készítése (6)</a> |

    Belépve: {{authCustomer()->name }}
    <form action="{{route('login.destroy')}}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
        <button type="submit" class="btn btn-primary m-3">Ügyfél kilépés (4)</button>
    </form>
@else
    <a href="{{route('customers.create')}}">Ügyfél regisztráció (3)</a> |
    <a href="{{route('login.create')}}">Ügyfél belépés (4)</a> |
@endif


@if(!auth()->guard('customer')->check())
    @if(auth()->guard()->check())

        Belépve admin: {{auth()->guard()->user()->name }}
        <form action="{{route('admin.logout')}}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            @csrf
            <button type="submit" class="btn btn-primary m-3">Admin kilépés (5)</button>
        </form>
    @else
        <a href="{{route('admin.login.create')}}">Admin belépés (5)</a> |
    @endif
@endif


