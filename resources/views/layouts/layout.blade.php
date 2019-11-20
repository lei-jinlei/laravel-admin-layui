<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ config('app.name', 'Admin') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('static/layui/css/layui.css') }}">
    @yield('head')
</head>

<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">{{ config('app.name', 'Admin') }}</div>

        <!-- 头部区域(左) -->
    {{--<ul class="layui-nav layui-layout-left">--}}
    {{--<li class="layui-nav-item"><a href="">控制台</a></li>--}}
    {{--<li class="layui-nav-item"><a href="">商品管理</a></li>--}}
    {{--<li class="layui-nav-item"><a href="">用户</a></li>--}}
    {{--<li class="layui-nav-item">--}}
    {{--<a href="javascript:;">其它系统</a>--}}
    {{--<dl class="layui-nav-child">--}}
    {{--<dd><a href="">邮件管理</a></dd>--}}
    {{--<dd><a href="">消息管理</a></dd>--}}
    {{--<dd><a href="">授权管理</a></dd>--}}
    {{--</dl>--}}
    {{--</li>--}}
    {{--</ul>--}}

    <!-- 头部区域(右) -->
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    {{ Auth::user()->name }}
                </a>
                @can('system.user.edit')
                    <dl class="layui-nav-child">
                        <dd><a href="{{ route('admin.user.edit', ['id' => Auth::user()->id]) }}">基本资料</a></dd>
                    </dl>
                @endcan
            </li>
            <li class="layui-nav-item">
                <a href="{{route('admin.logout')}}">退出</a>
            </li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">

            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree" id="left-menu">

                <li class="layui-nav-item">

                    <a href="{{ route('admin.index') }}" lay-tips="首页">
                        <i class="layui-icon layui-icon-home"></i>
                        <cite>首页</cite>
                    </a>
                </li>

                @foreach($menus as $menu)
                    @can($menu->name)

                        {{-- 主目录 --}}
                        <li data-name="{{$menu->name}}" class="layui-nav-item
                            @foreach($menu->childs as $subMenu)
                        @if(request()->routeIs($subMenu->route)) layui-nav-itemed  @break @endif
                        @endforeach
                                ">
                            <a href="javascript:;" lay-tips="{{$menu->display_name}}" lay-direction="2">
                                <i class="layui-icon {{$menu->icon->class??''}}"></i>
                                <cite>{{$menu->display_name}}</cite>
                            </a>

                            {{-- 二级目录 --}}
                            @if($menu->childs->isNotEmpty())
                                <dl class="layui-nav-child">
                                    @foreach($menu->childs as $subMenu)
                                        @can($subMenu->name)
                                            <dd data-name="{{$subMenu->name}}" @if(request()->routeIs($subMenu->route)) class="layui-this" @endif>
                                                <a href="{{route($subMenu->route)}}">
                                                    {{$subMenu->display_name}}
                                                </a>
                                            </dd>
                                        @endcan
                                    @endforeach
                                </dl>
                            @endif

                        </li>
                    @endcan
                @endforeach
            </ul>
        </div>
    </div>

    <div class="layui-body">
        @yield('content')
    </div>

</div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('static/layui/layui.js') }}"></script>
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
        var element = layui.element;
        var layer = layui.layer;
        var form = layui.form;
        var table = layui.table;
        var upload = layui.upload;
        var laydate = layui.laydate;

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