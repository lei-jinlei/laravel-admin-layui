@extends('admin.layouts.page')

@section('content')
    <div class="layui-card">

        <div class="layui-card-body">
            <div class="layui-form" >
                <div class="layui-input-inline">
                    <input type="number" name="id" id="id" placeholder="ID" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <label class="layui-form-label">用户</label>
                    <div class="layui-input-block">
                        <select name="user_id" id="user_id">
                            <option value=""></option>
                            @foreach($users as $user_id => $name)
                                <option value="{{ $user_id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-input-inline">
                    <label class="layui-form-label">请求方式</label>
                    <div class="layui-input-block">
                        <select name="method" id="method">
                            <option value=""></option>
                            @foreach($methods as $method)
                                <option value="{{ $method }}">{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="path" id="path" placeholder="路径" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="ip" id="ip" placeholder="ip" class="layui-input">
                </div>

                <div class="layui-input-inline">
                    <button class="layui-btn layui-btn-sm" id="searchBtn">搜 索</button>
                </div>

            </div>
        </div>
    </div>

    <div class="layui-card">
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="user">
                @{{ d.user.name }}
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('system.role')
        <script>
            layui.use(['layer','table','form'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,url: "{{ route('admin.operationLog.data') }}" //数据接口
                    ,where:{}
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID', sort: true,width:80}
                        ,{field: 'user', title: '用户', toolbar:'#user'}
                        ,{field: 'method', title: '请求方式'}
                        ,{field: 'path', title: '路径'}
                        ,{field: 'ip', title: 'ip'}
                        ,{field: 'input', title: '参数'}
                    ]]
                });


                //搜索
                $("#searchBtn").click(function () {
                    var id = $("#id").val();
                    var user_id = $("#user_id").val();
                    var method = $("#method").val();
                    var path = $("#path").val();
                    var ip = $("#ip").val();
                    dataTable.reload({
                        where:{
                            id:id,
                            user_id:user_id,
                            method:method,
                            path:path,
                            ip:ip
                        },
                        page:{curr:1}
                    })
                })


                //监听排序事件
                table.on('sort(dataTable)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                    console.log(obj.field); //当前排序的字段名
                    console.log(obj.type); //当前排序类型：desc（降序）、asc（升序）、null（空对象，默认排序）
                    console.log(this); //当前排序的 th 对象

                    var id = $("#id").val();
                    var user_id = $("#user_id").val();
                    var method = $("#method").val();
                    var path = $("#path").val();
                    var ip = $("#ip").val();

                    //尽管我们的 table 自带排序功能，但并没有请求服务端。
                    //有些时候，你可能需要根据当前排序的字段，重新向服务端发送请求，从而实现服务端排序，如：
                    dataTable.reload({
                        initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                        ,where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                            id:id
                            ,user_id:user_id
                            ,method:method
                            ,path:path
                            ,ip:ip
                            ,field: obj.field //排序字段
                            ,order: obj.type //排序方式
                        }
                    });
                });

            })


        </script>
    @endcan
@endsection