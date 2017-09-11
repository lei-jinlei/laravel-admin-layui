@extends('tasks.app')

@section('content')

    <!-- Bootstrap 模版... -->

    <div class="panel-body">
        <!-- 显示验证错误 -->
        @include('tasks.errors')
        <!-- 新任务的表单 -->
        <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- 任务名称 -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- 增加任务按钮-->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> 增加任务
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- 代办：目前任务 -->
@endsection
