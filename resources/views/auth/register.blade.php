@extends('app')

@section('title', '註冊')

@section('content')
    <div class="ui center aligned text container">
        <h2 class="ui teal image header">
            Register
        </h2>
        {!! SemanticForm::open()->post()->action(action('Auth\AuthController@register'))->addClass('large') !!}
        <div class="ui stacked segment">
            <div class="field{{ $errors->has('name') ? ' error' : '' }}">
                <div class="ui left icon input">
                    <i class="user icon"></i>
                    {!! SemanticForm::text('name')->placeholder('Name / Nickname')->required() !!}
                </div>
            </div>
            <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                <div class="ui left icon input">
                    <i class="mail icon"></i>
                    {!! SemanticForm::email('email')->placeholder('E-mail address')->required() !!}
                </div>
            </div>
            <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                <div class="ui left icon input">
                    <i class="lock icon"></i>
                    {!! SemanticForm::password('password')->placeholder('Password')->required() !!}
                </div>
            </div>
            <div class="field{{ $errors->has('password_confirmation') ? ' error' : '' }}">
                <div class="ui left icon input">
                    <i class="lock icon"></i>
                    {!! SemanticForm::password('password_confirmation')->placeholder('Password Confirmation')->required() !!}
                </div>
            </div>
            <div class="ui two column equal width grid">
                <div class="column">
                    {!! SemanticForm::submit('Register')->addClass('fluid large teal submit') !!}
                </div>
                <div class="column">
                    <a href="{{ route('auth.login') }}" class="ui fluid large orange button">Login</a>
                </div>
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
    </div>
@endsection
