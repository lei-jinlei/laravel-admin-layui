<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Sample App') - Laravel 学习之旅</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('layouts._header')

    <div class="container">
      @include('shared._message')
      @yield('content')
      @include('layouts._footer')
    </div>

    <script src="/js/app.js"></script>
  </body>
</html>
