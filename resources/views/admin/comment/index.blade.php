@extends('layouts.admin')

@section('content')
<script src="{{ URL::asset('js/table/table_scroll.min.1.02.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">评论管理</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th>内容</th>
                              <th>评论用户</th>
                              <th>Page</th>
                              <th>编辑</th>
                              <th>删除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->content }}</td>
                                    <td>{{ $comment->nickname }}</td>
                                    <td>{{ $comment->hasOneArticle->title }}</td>
                                    <td><a href="{{ url('admin/comment/'.$comment->id.'/edit') }}" class="btn btn-success">编辑</a></td>
                                    <td>
                                        <form action="{{ url('admin/comment/'.$comment->id) }}" method="POST" style="display: inline;">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('table').table_scroll({
    beginRow:0,
    rowInScrollableArea:5
});
</script>
@endsection
