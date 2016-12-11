@extends('app')

@php($isEditMode = isset($sensor))
@php($methodText = $isEditMode ? '編輯' : '新增')

@section('title', $methodText . '感測器')

@section('content')
    <h2 class="ui teal header center aligned">
        {{ $methodText }}感測器
    </h2>
    @if($isEditMode)
        {!! SemanticForm::open()->action(route('sensor.update', $sensor))->patch() !!}
        {!! SemanticForm::bind($sensor) !!}
    @else
        {!! SemanticForm::open()->action(route('sensor.store')) !!}
    @endif
    <div class="ui stacked segment">
        {!! SemanticForm::text('name')->label('感測器名稱')->placeholder('如：小白')->required() !!}
        {!! SemanticForm::select('type', $devices)->label('感測器類型')->placeholder('說明此感測器之用途') !!}
        {!! SemanticForm::select('unit', $units)->label('資料單位')->placeholder('說明此感測器之用途') !!}
        {!! SemanticForm::text('location')->label('感測器位置')->placeholder('說明此感測器之用途') !!}

        <div style="text-align: center">
            <a href="{{ route('sensor.index') }}" class="ui blue inverted icon button">
                <i class="icon arrow left"></i> 返回列表
            </a>
            {!! SemanticForm::submit('<i class="checkmark icon"></i> 確認')->addClass('ui icon submit red inverted button') !!}
        </div>
    </div>
    @if($errors->count())
        <div class="ui error message" style="display: block">
            <ul class="list">
                @foreach($errors->all('<li>:message</li>') as $error)
                    {!! $error !!}
                @endforeach
            </ul>
        </div>
    @endif
    {!! SemanticForm::close() !!}
@endsection
