<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content=" {{ csrf_token() }} ">
    <meta name="description" content="@yield('description', setting('seo_description', 'LaraBBS 爱好者社区。'))" />
    <meta name="keyword" content="@yield('keyword', setting('keyword', 'LaraBBS,社区,论坛,开发者论坛 '))">

    <title> @yield('title', 'laraBBS') - Laravel 进级教程</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')

</head>
<body>
    <div id="app" class="{{ route_class() }}-page">

        @include('layouts._header')

        <div class="container">

            @include('layouts._message')
            @yield('content')

        </div>

        @include('layouts._footer')
    </div>

    @if(app()->isLocal())
        @include('sudosu::user-selector')
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>