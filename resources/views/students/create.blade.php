@extends('layouts.default')
@section('title', '添加学生')

@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>添加学生</h5>
        </div>
        <div class="panel-body">
            @include('shared._errors')
            
            <form class="" action="{{ route('students.store') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">名称：</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="age">年龄：</label>
                    <input type="number" name="age" class="form-control" value="{{ old('age') }}">
                    
                </div>
                <div class="form-group">
                    <label for="sex">性别：</label>
                    <select name="sex" class="form-control">
                        <option value="0">保密</option>
                        <option value="1">男</option>
                        <option value="2">女</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">注册</button>
            </form>
        </div>
    </div>
</div>
@endsection