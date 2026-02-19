<x-logout-layout>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <main class="login_container">
        <div class="form_box">
            {!! Form::open(['url' => 'register']) !!}

            <h2 class="welcome_text">新規ユーザー登録</h2>

            @if ($errors->any())
                <div class="error_message_container">
                    <ul class="error_message">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form_field">
                {{ Form::label('username', 'ユーザー名', ['class' => 'form_label']) }}
                <div class="input_wrapper">
                    {{ Form::text('username', null, ['class' => 'input_control']) }}
                </div>
            </div>

            <div class="form_field">
                {{ Form::label('email', 'メールアドレス', ['class' => 'form_label']) }}
                <div class="input_wrapper">
                    {{ Form::email('email', null, ['class' => 'input_control']) }}
                </div>
            </div>

            <div class="form_field">
                {{ Form::label('password', 'パスワード', ['class' => 'form_label']) }}
                <div class="input_wrapper">
                    {{ Form::password('password', ['class' => 'input_control']) }}
                </div>
            </div>

            <div class="form_field">
                {{ Form::label('password_confirmation', 'パスワード（確認用）', ['class' => 'form_label']) }}
                <div class="input_wrapper">
                    {{ Form::password('password_confirmation', ['class' => 'input_control']) }}
                </div>
            </div>

            <div class="submit_area">
                {{ Form::submit('新規登録', ['class' => 'btn_submit']) }}
            </div>

            <p class="back_to_login">
                <a href="/login">ログイン画面へ戻る</a>
            </p>

            {!! Form::close() !!}
        </div>
    </main>
</x-logout-layout>
