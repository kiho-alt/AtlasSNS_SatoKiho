<x-logout-layout>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <main class="login_container">
        <div class="form_box">
            {!! Form::open(['url' => 'login']) !!}

            <p class="welcome_text">AtlasSNSへようこそ</p>

            @if ($errors->any())
                <div class="error_message_container">
                    <p class="error_message">メールアドレスまたはパスワードが違います。</p>
                </div>
            @endif

            <div class="form_field">
                {{ Form::label('email', 'メールアドレス', ['class' => 'form_label']) }}
                <div class="input_wrapper">
                    {{ Form::text('email', null, ['class' => 'input_control']) }}
                </div>
            </div>

            <div class="form_field">
                {{ Form::label('password', 'パスワード', ['class' => 'form_label']) }}
                <div class="input_wrapper">
                    {{ Form::password('password', ['class' => 'input_control']) }}
                </div>
            </div>

            <div class="submit_area">
                {{ Form::submit('ログイン', ['class' => 'btn_submit']) }}
            </div>

            <p class="register_link">
                <a href="/register">新規ユーザーの方はこちら</a>
            </p>

            {!! Form::close() !!}
        </div>
    </main>
</x-logout-layout>
