@extends('layouts.default')
@section('title', '修改学生')

@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>添加学生</h5>
        </div>
        <div class="panel-body">
            @include('shared._errors')
            
            <form class="" action="{{ route('students.update', $student->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="name">名称：</label>
                    <input type="text" name="name" class="form-control" value="{{ $student->name }}">
                </div>
                <div class="form-group">
                    <label for="age">年龄：</label>
                    <input type="number" name="age" class="form-control" value="{{ $student->age }}">                    
                    
                </div>
                <div class="form-group">
                    <label for="sex">性别：</label>
                    <select name="sex" class="form-control">
                        <option value="0" @if ($student->sex == '保密') selected @endif >保密</option>
                        <option value="1" @if ($student->sex == '男') selected @endif >男</option>
                        <option value="2" @if ($student->sex == '女') selected @endif >女</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection