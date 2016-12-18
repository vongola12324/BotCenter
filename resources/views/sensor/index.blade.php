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
    <div class="ui raised red segment" style="margin-bottom: 20px">
        <h2 class="ui header">如何使用</h2>
        <p>伺服器提供兩組API供感測器及其他裝置傳送、接收資料，這兩組API共用一個網址： <code>{{ env('APP_URL').'/api/data' }}</code> </p>
        <h3 class="ui header">傳送資料</h3>
        <p>
            傳送資料時，請使用POST方法來傳送，伺服器只接受json格式，並且請確保json內容包含data及token兩個欄位。<br>
            範例格式：
        </p>
        <pre><code>
                {
                    "data": 20,
                    "token": "b7c171a9-b8bb-4cb3-850f-47d839747171"
                }
        </code></pre>
        <h3 class="ui header">接收資料</h3>
        <p>
            傳送資料時，請使用GET方法來傳送，伺服器會回傳一個要求的資料的json。<br>
            支援的要求限制：<br>
            <div class="ui list">
                <div class="item">name: 裝置名稱</div>
                <div class="item">type: 裝置類型</div>
                <div class="item">limit: 資料筆數(上限)</div>
            </div>
            範例網址：
        </p>
        <pre><code>
        {{ env('APP_URL').'/api/data?limit=10' }}
        {{ env('APP_URL').'/api/data?name=測試&limit=50' }}
        {{ env('APP_URL').'/api/data?type=Temperature' }}
        </code></pre>

    </div>
@endsection
