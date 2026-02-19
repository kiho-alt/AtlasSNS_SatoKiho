<x-logout-layout>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <main class="form_container">
        <div class="added_box">
            <div id="messageContent">
                <p class="welcome_text">{{ session('username') }}さん、<br>ようこそ！AtlasSNSへ</p>

                <div class="message_body">
                    <p>ユーザー登録が完了いたしました。<br>
                    早速ログインをしてみましょう！</p>
                </div>

                <p class="btn_link_container">
                    <a href="/login" class="btn_red">ログイン画面へ</a>
                </p>
            </div>
        </div>
    </main>
</x-logout-layout>
