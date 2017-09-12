@extends('tasks.app')

@section('content')
    <!-- 创建任务表单... -->

    <!-- 目前任务 -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                目前任务
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- 表头 -->
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- 表身 -->
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <!-- 任务名称 -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>

                            <!-- 删除按钮 -->
                            <td>
                                <form action="/task/{{ $task->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button>删除任务</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
