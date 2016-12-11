@extends('app')

@section('title', '登入')

@section('content')

    <div class="ui center aligned text container">
        <h2 class="ui teal image header">
            登入
        </h2>
        {!! SemanticForm::open()->action(action('Auth\AuthController@login'))->addClass('large') !!}
        <div class="ui stacked segment">
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
            {!! SemanticForm::checkbox('remember')->label('Remember Me')->addClass('left aligned') !!}
            <div class="ui three column equal width grid">
                <div class="column">
                    {!! SemanticForm::submit('Login')->addClass('fluid large teal submit') !!}
                </div>
                <div class="column">
                    <a href="{{ route('auth.password.reset') }}" class="ui fluid large red button">Reset Password</a>
                </div>
                <div class="column">
                    <a href="{{ route('auth.register') }}" class="ui fluid large orange button">Register</a>
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
