@extends('layouts.default')
@section('title', '学生详情')

@section('content')
<div class="row">
    <h1><a href="{{ route('students.index') }}"> 学生列表</a></h1>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>姓名</th>
                <th>性别</th>
                <th>年龄</th>
                <th>创建时间</th>
                <th>修改时间</th>
                <th>操作</th>
                <th>删除</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->sex }}</td>
                <td>{{ $student->age }}</td>
                <td>{{ $student->created_at }}</td>
                <td>{{ $student->updated_at }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-default">修改</a>
                </td>
                <td>
                    <form action="{{ route('students.destroy', $student->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger delete-btn">刪除</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
