@extends('layouts.default')
@section('title', '文件上传')

@section('content')
<div class="col-md-offset-2 col-md-8">
    <h3><a href="{{ route('students.index') }}">学生列表</a></h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>添加文件</h5>
        </div>
        <div class="panel-body">
            @include('shared._errors')
            
            <form class="form" action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="file">请选择文件:</label>
                    <input type="file" name="source" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">确认上传</button>
            </form>
        </div>
    </div>
</div>
@endsection