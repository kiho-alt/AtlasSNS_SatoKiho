<x-login-layout>
    <main class="search_main">
        <div class="search_container">
            <div class="search_form_area">
                <form action="{{ route('user.search') }}" method="GET" class="search_form">
                    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="ユーザー名" class="search_input">

                    <div class="search_btn_wrap">
                        <button type="submit" class="search_btn_img">
                            <img src="{{ asset('images/search.png') }}" alt="検索">
                        </button>
                    </div>
                </form>

                @if(!empty($keyword))
                    <p class="search_word_display">検索ワード：{{ $keyword }}</p>
                @endif
            </div>
            <p class="search_divider"></p>
        </div>

        <div class="user_list">
            @foreach($users as $user)
                <div class="user_item">
                    <div class="user_info">
                        <div class="user_icon_wrap">
                            <img src="{{ $user->getIconPath() }}" alt="icon" class="user_icon">
                        </div>
                        <p class="user_name">{{ $user->username }}</p>
                    </div>

                    <div class="follow_btn_area">
                        @if(Auth::user()->isFollowing($user->id))
                            <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">フォロー解除</button>
                            </form>
                        @else
                            <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">フォローする</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</x-login-layout>
