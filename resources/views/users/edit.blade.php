@extends('layouts.app')
@section('title', $user->name)

@section('content')

    <div class="container">
        <div class="panel panel-default col-md-10 col-md-offset-1">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                </h4>
            </div>

            @include('common.error')

            <div class="panel-body">

                <form action="{{ route('users.update', $user->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input type="text" name="name" class="form-control" id="name-field" value="{{ old('name', $user->name) }}" />
                    </div>
                    
                    <div class="form-group">
                        <label for="email-field">邮 箱</label>
                        <input type="text" name="email" class="form-control" id="email-field" value="{{ old('email', $user->email) }}" />
                    </div>

                    <div class="form-group">
                        <label for="introduction-field">个人简介</label>
                        <textarea type="text" name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="" class="avatar-label">用户头像</label>
                        <input type="file" name="avatar">

                        @if($user->avatar)
                            <br>
                            <img class="thumbnail img-responsive" src="{{ $user->avatar }}" alt="{{ $user->name }}" width="200" />
                        @endif
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection