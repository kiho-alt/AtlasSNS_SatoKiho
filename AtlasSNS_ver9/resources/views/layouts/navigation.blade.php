<header id="headContainer">
    <div id="head">
        <h1 class="main_logo">
            <a href="{{ route('top') }}">
                <div class="logo_wrap">
                    <img src="{{ asset('images/atlas.png') }}" alt="Atlas">
                </div>
            </a>
        </h1>

        <nav class="nav_container">
            <div class="nav_info js-menu-open">
                <p class="nav_username">{{ Auth::user()->username }} さん</p>
                <span class="nav_arrow"></span>
                <div class="nav_icon_wrap">
                    <img src="{{ Auth::user()->getIconPath() }}" alt="icon" class="icon">
                </div>
            </div>

            <ul class="nav_menu">
                <li class="menu_item"><a href="{{ route('top') }}">HOME</a></li>
                <li class="menu_item"><a href="/profile">プロフィール編集</a></li>
                <li class="menu_item"><a href="{{ route('logout') }}">ログアウト</a></li>
            </ul>
        </nav>
    </div>
</header>
