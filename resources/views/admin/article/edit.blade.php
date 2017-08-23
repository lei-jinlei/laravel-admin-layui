@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">修改一篇文章</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/article/'.$articles->id) }}" method="POST">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}
                        <input type="text" name="title" class="form-control" required="required" placeholder="请输入标题" value="{{ $articles->title }}">
                        <br>
                        <textarea name="body" rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $articles->body }}</textarea>
                        <br>
                        <input type="hidden" name="id" value="{{ $articles->id }}">
                        <button class="btn btn-lg btn-info">修改文章</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
