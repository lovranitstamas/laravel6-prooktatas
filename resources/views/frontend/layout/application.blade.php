<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link href="/css/app.css" rel="stylesheet">
@include('frontend.layout.head')

<body>

@include('frontend.layout.menu')
<div class="container m-5">
    @yield('content')
    @yield('footer')
</div>

@include('frontend.layout.scripts')

</body>
</html>
