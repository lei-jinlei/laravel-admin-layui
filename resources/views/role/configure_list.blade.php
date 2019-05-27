@extends('layouts.app')

@section('content')

    <div class="container">
        <caption>配置列表：</caption>
        @isset($accounts)
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>游戏名</th>
                    <th>类型</th>
                    <th>邮件</th>
                    <th>非法字符</th>
                    <th>MIN</th>
                    <th>MAX</th>
                    <th>预警值</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->game_name }}</td>
                        <td>{{ $account->unique_type_text }}</td>
                        <td>{{ $account->email}}</td>
                        <td>{{ $account->character }}</td>
                        <td>{{ $account->min }}</td>
                        <td>{{ $account->max }}</td>
                        <td>{{ $account->warning }}</td>
                        <td><a href="/configure_edit?id={{$account->id}}"><span>编辑</span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endisset
        <a type="submit"
           href="/configure_set"
           class="btn btn-primary">新增</a>
    </div>
@endsection