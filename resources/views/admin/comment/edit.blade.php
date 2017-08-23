@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">修改评论</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>新增失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/comment/'.$comments->id) }}" method="POST">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}
                        评论标题
                        <input class="form-control" type="text" placeholder="{{ $comments->hasOneArticle->title }}" readonly>
                        <br>
                        Nickname
                        <input type="text" name="nickname" class="form-control" required="required" placeholder="请输入标题" value="{{ $comments->nickname }}">
                        <br>
                        Email
                        <input type="text" name="email" class="form-control" placeholder="请输入标题" value="{{ $comments->email }}">
                        <br>
                        Website
                        <input type="text" name="website" class="form-control" placeholder="请输入标题" value="{{ $comments->website }}">
                        <br>
                        Content
                        <textarea name="content" rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $comments->content }}</textarea>
                        <br>
                        <input type="hidden" name="id" value="{{ $comments->id }}">
                        <button class="btn btn-lg btn-info">修改文章</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
