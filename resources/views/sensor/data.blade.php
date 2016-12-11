@extends('app')

@section('title', '感測器資料')

@section('content')
    <h2 class="ui teal header center aligned">
        感測器資料清單
    </h2>
    <a href="{{ route('sensor.index') }}" class="ui icon blue inverted button">
        <i class="arrow left icon" aria-hidden="true"></i> 返回感測器清單
    </a>
    {!! Form::open([
                        'method' => 'POST',
                        'route' => ['envdata.clear'],
                        'style' => 'display: inline',
                        'onSubmit' => "return confirm('確定要清除所有資料嗎？');"
                    ]) !!}
    <button type="submit" class="ui icon red inverted button">
        <i class="recycle icon"></i> 清除所有資料
    </button>
    {!! Form::close() !!}
    <table class="ui selectable celled padded unstackable table">
        <thead>
        <tr style="text-align: center">
            <th class="single line">時間</th>
            <th class="single line">感測器</th>
            <th class="single line">資料</th>
            <th class="single line">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($datas as $data)
            <tr>
                <td class="two wide">
                    {{ $data->created_at }}
                </td>
                <td  class="three wide">
                    {{ $data->sensor->name }}（{{ $data->sensor->type }}/{{ $data->sensor->location }}）
                </td>
                <td>
                    {{ $data->data }} {{ $data->sensor->unit }}
                </td>
                <td class="two wide">
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['envdata.destroy', $data],
                        'style' => 'display: inline',
                        'onSubmit' => "return confirm('確定要刪除此資料嗎？');"
                    ]) !!}
                    <button type="submit" class="ui icon red inverted disabled button">
                        <i class="trash icon"></i> 刪除資料
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
