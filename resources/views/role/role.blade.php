@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-inline" role="form" action="/role_list">
{{--            {{ csrf_field() }}--}}
            <div class="form-group">
                <select type="text" class="form-control"  name="game_id" placeholder="请选择游戏">
                    <option @if(!is_numeric(request()->input("game_id")))
                            selected="selected"
                            @endif
                            value="">请选择游戏
                    </option>
                    @foreach ($game_list as $id => $name)
                        <option @if(request()->input("game_id") == $id)
                                selected="selected"
                                @endif
                                value="{{ $id }}">{{ $name }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <select type="text" class="form-control"  name="type" placeholder="请选择操作">
                    <option @if(!is_numeric(request()->input("type")))
                            selected="selected"
                            @endif
                            value="">请选择操作
                    </option>
                    @foreach ($type as $id => $name)
                        <option @if(request()->input("type") == $id)
                                selected="selected"
                                @endif
                                value="{{ $id }}">{{ $name }}
                        </option>
                    @endforeach

                </select>
            </div>
            <button type="submit" class="btn btn-primary">搜索</button>
            <a type="submit"
               href="/excelImport?game_id={{request("game_id")}}"
               class="btn btn-primary">导入</a>
            <a type="submit"
               href="/configure_list"
               class="btn btn-primary">配置</a>
        </form>
        @isset($accounts)
        @if(request('type')==1)
        <table class="table table-bordered">
            <caption>剩余角色名:<span style="color: red">{{$count}}</span></caption>
            <thead>
            <tr>
                <th>名称</th>
                <th>创建时间</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($accounts as $account)
                <tr>
                    <td>{{ $account->role_name }}</td>
                    <td>{{ date("Y-m-d H:i",$account->create_time)}}</td>
                    <td>@if($account->disable==1)<a href="#" onclick="showInputDialog(this)" data-bid="{{ $account->id}}" data-disable="{{$account->disable}}"><span style="color: red">禁用</span></a>
                        @else <a href="#" onclick="showInputDialog(this)" data-bid="{{ $account->id}}" data-disable="{{$account->disable}}"><span>启用</span></a>@endif</td>
                </tr>
            @endforeach
            </tbody>
        </table>
            {{ $accounts->appends(array(
            'game_id' => request()->input('game_id'),
            'type' => request()->input('type'),
        ))->links() }}
        @elseif(request('type')==2)
            <table class="table table-bordered">
                <caption>已使用角色名:<span style="color: red">{{$count}}</span></caption>
                <thead>
                <tr>
                    <th>名称</th>
                    <th>使用时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->role_name }}</td>
                        <td>{{ $account->use_time }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $accounts->appends(array(
        'game_id' => request()->input('game_id'),
        'type' => request()->input('type'),
    ))->links() }}
        @endif
        @endisset

    </div>
    <script>
        function showInputDialog(_this) {
            var btn = $(_this);
            var bid = _this.getAttribute('data-bid');
            var disable = _this.getAttribute('data-disable');
            $.ajax({
                type:"GET",
                url:"/roleEdit?bid="+bid+"&role_disable="+disable,
                dataType:"json",
                success:function(data){
                    console.log(data.data);
                    if(data.success==true){
                        if(data.data==1){
                            var disable = 0;
                            btn.parent().html("<a href=\"#\" onclick=\"showInputDialog(this)\" data-bid="  + bid + "data-disable=" + disable + "><span>启用</span></a>");
                            }
                        else{
                            var disable = 1;
                            btn.parent().html("<a href=\"#\" onclick=\"showInputDialog(this)\" data-bid="  + bid + "data-disable=" + disable + "><span style=\"color: red\">禁用</span></a>");
                        }
                    }else{
                        alert(data.success);
                    }
                }

            });

        }
    </script>

@endsection