@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" action="/lessons_excel" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            @if(isset($game_id))
            <input  type="hidden" class="form-control" name="game_id" value="{{$game_id}}">
            @elseif(isset($game_list))
                <label for="name">选择游戏：</label>
            <div class="form-group">
                <select type="text" class="form-control"  name="game_id" placeholder="请选择游戏">
                    <option value="">请选择游戏</option>
                    @foreach ($game_list as $id => $name)
                        <option value="{{ $id }}">{{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            <label for="file">选择文件</label>
            <input id="file" type="file" class="form-control" name="source" required>
            <button type="submit" class="btn btn-primary">确定</button>
        </form>
    </div>
@endsection