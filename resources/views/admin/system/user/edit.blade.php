@extends('admin.layouts.page')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>更新用户</h2>
        </div>
        <div class="layui-card-body">
            <form class="layui-form" action="{{route('admin.system.user.update',['user'=>$user])}}" method="post">
                <input type="hidden" name="id" value="{{$user->id}}">
                {{method_field('put')}}
                @include('admin.system.user._form')
            </form>
        </div>
    </div>
@endsection


