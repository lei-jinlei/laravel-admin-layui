<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页二</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('static/layui/css/layui.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('static/lib/font-awesome-4.7.0/css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('static/layui-mini/css/public.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/common.css?v=20191119') }}" media="all">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')
</head>
<body>
<div class="layuimini-container">
    @yield('content')
</div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('static/layui/layui.js') }}"></script>
<script src="{{ asset('static/layui/layui.all.js') }}"></script>
<script src="{{ asset('js/common.js?v=20191119') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    layui.config({
        base: '/static/layui_extends/',
    }).extend({
        excel: 'excel',
    });

    layui.use(['element','form','layer','table','upload','laydate'],function () {
        var layer = layui.layer;

        //错误提示
        @if(count($errors)>0)
        @foreach($errors->all() as $error)
        layer.msg("{{$error}}",{icon:5});
        @break
        @endforeach
        @endif

        //信息提示
        @if(session('status'))
        layer.msg("{{session('status')}}",{icon:6});
        @endif
    });
</script>
@yield('script')
</body>
</html>