@extends('layouts.app')

@section('content')
    <div class="container">
        <form role="form" action="/configure_set">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">游戏</label>
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
            <div class="form-group" role="form" action="/set">
                <label for="name">类型</label>
                <select type="text" class="form-control"  name="unique_type" placeholder="请选择类型">
                    <option @if(!is_numeric(request()->input("unique_type")))
                            selected="selected"
                            @endif
                            value="">请选择类型
                    </option>
                    @foreach ($unique_type as $id => $name)
                        @if(request()->input("unique_type") == $id)
                            selected="selected"
                        @endif
                        <option value="{{ $id }}">{{ $name }}
                        </option>
                    @endforeach

                </select>
            </div>
            @if(isset($accounts))
                @foreach ($accounts as $account)
                    <input type="hidden" class="form-control" name="id" >
                    <div class="form-group">
                        <label for="name">Min Num</label>
                        <input type="text" class="form-control" name="min" value="{{$account->min}}" placeholder="请输入最小值">
                    </div>
                    <div class="form-group">
                        <label for="name">Max Num</label>
                        <input type="text" class="form-control" name="max" value="{{$account->max}}"   placeholder="请输入最大值">
                    </div>
                    <div class="form-group">
                        <label for="name">预警阈值</label>
                        <input type="text" class="form-control" name="warning"  value="{{$account->warning}}"  placeholder="请输入预警值">
                    </div>
                    <div class="form-group">
                        <label for="name">非法字符</label>
                        <textarea type="text" class="form-control" name="character"  placeholder="请输入非法字符，逗号分隔">
                            {{$account->character}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">邮件接收人</label>
                        <textarea type="text" class="form-control" name="email"  placeholder="邮件接收人，逗号分隔">
                           {{$account->email}}
                        </textarea>
                    </div>
                @endforeach
            @else
            <input type="hidden" class="form-control" name="id" >
            <div class="form-group">
                <label for="name">Min Num</label>
                <input type="text" class="form-control" name="min" placeholder="请输入最小值">
            </div>
            <div class="form-group">
                <label for="name">Max Num</label>
                <input type="text" class="form-control" name="max"   placeholder="请输入最大值">
            </div>
            <div class="form-group">
                <label for="name">预警阈值</label>
                <input type="text" class="form-control" name="warning"   placeholder="请输入预警值">
            </div>
            <div class="form-group">
                <label for="name">非法字符</label>
                <textarea type="text" class="form-control" name="character"   placeholder="请输入非法字符，逗号分隔">
                    </textarea>
            </div>
            <div class="form-group">
                <label for="name">邮件接收人</label>
                <textarea type="text" class="form-control" name="email"   placeholder="邮件接收人，逗号分隔">
                    </textarea>
            </div>
            @endif
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>
@endsection