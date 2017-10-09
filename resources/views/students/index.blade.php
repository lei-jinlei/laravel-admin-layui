@extends('layouts.default')
@section('title', '学生列表')

@section('content')
<div class="row">
    <div class="col-md-8">
        @if (Auth::check())
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
            </aside>
        @endif
    </div>
</div>
<div class="row">
    <h3><a href="{{ route('students.create') }}">添加学生</a></h3>
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
            @foreach ($students as $student)
            <tr>
                <td><a href="{{ route('students.show', $student->id) }}">{{ $student->name }}</a></td>
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
            @endforeach
        </tbody>
    </table>
    {!! $students->render() !!}
</div>
@endsection