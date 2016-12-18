@extends('app')

@section('title', '感測器管理')

@section('content')
    <h2 class="ui teal header center aligned">
        感測器管理
    </h2>
    <h3 class="ui header center aligned">感測器清單</h3>
    <a href="{{ route('sensor.create') }}" class="ui icon brown inverted button">
        <i class="plus icon" aria-hidden="true"></i> 新增感測器
    </a>
    <a href="{{ route('envdata') }}" class="ui icon brown inverted button">
        <i class="list layout icon" aria-hidden="true"></i> 所有感測器資料
    </a>
    <table class="ui selectable celled padded unstackable table">
        <thead>
        <tr style="text-align: center">
            <th class="single line">感測器</th>
            <th class="single line">金鑰(Token)</th>
            <th class="single line">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sensors as $sensor)
            <tr>
                <td class="four wide">
                    {{ $sensor->name }}({{ $sensor->location }})<br>
                    <small><i class="angle double right icon"></i>{{ $sensor->type }}/{{ $sensor->unit }}</small>
                </td>
                <td style="text-align: center">
                    {{ base64_decode($sensor->api_key) }}
                </td>
                <td class="four wide">
                    <a href="{{ route('sensor.edit', $sensor) }}" class="ui icon brown inverted button">
                        <i class="edit icon"></i> 編輯
                    </a>
                    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['envdata', 'token' => $sensor->api_key],
                        'style' => 'display: inline',
                    ]) !!}
                    <button type="submit" class="ui icon green inverted button">
                        <i class="search icon"></i> 檢視
                    </button>
                    {!! Form::close() !!}
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['sensor.destroy', $sensor],
                        'style' => 'display: inline',
                        'onSubmit' => "return confirm('確定要刪除此感測器嗎？');"
                    ]) !!}
                    <button type="submit" class="ui icon red inverted button">
                        <i class="trash icon"></i> 刪除
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
