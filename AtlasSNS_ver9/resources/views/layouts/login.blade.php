<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!-- <link rel="stylesheet" href="{{ asset('css/logout.css') }} "> -->
  <link rel="stylesheet" href="{{ asset('css/modal.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        @include('layouts.navigation')
    </header>

    <div id="mainRow">
        <div id="mainContainer">
            {{ $slot }}
        </div>

        <aside id="sideBr">
            <div class="side_content">
                <p class="side_username">{{ Auth::user()->username }}さんの</p>

                <div class="side_row">
                    <p>フォロー数</p>
                    <p>{{ Auth::user()->follows()->count() }}人</p>
                </div>

                <div class="side_btn_container">
                    <a href="/follow-list" class="side_btn">フォローリスト</a>
                </div>

                <div class="side_row">
                    <p>フォロワー数</p>
                    <p>{{ Auth::user()->followers()->count() }}人</p>
                </div>

                <div class="side_btn_container">
                    <a href="/follower-list" class="side_btn">フォロワーリスト</a>
                </div>
            </div>

            <hr class="side_separator">

            <div class="side_search_container">
                <a href="/search" class="side_search_btn">ユーザー検索</a>
            </div>
        </aside>
    </div>

    <footer>
    </footer>

    <script src="{{ asset('js/jquery-4.0.0.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
</body>

</html>
