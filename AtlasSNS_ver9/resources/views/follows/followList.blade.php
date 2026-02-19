<x-login-layout>
    <main class="list_main">
        <div class="list_header">
            <h2 class="list_title">フォローリスト</h2>

            <div class="user_icons_area">
                @forelse($follows as $user)
                    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="user_icon_link">
                        <img src="{{ $user->getIconPath() }}" alt="icon" class="user_icon_img">
                    </a>
                @empty
                    <p class="empty_message">現在フォローしているユーザーはいません。</p>
                @endforelse
            </div>
        </div>

        <hr class="list_divider">

        <div class="timeline">
            @forelse($posts as $post)
                <div class="post_item">
                    <div class="post_icon_wrap">
                        <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
                            <img src="{{ $post->user->getIconPath() }}" alt="icon" class="post_user_icon">
                        </a>
                    </div>
                    <div class="post_content">
                        <div class="post_header">
                            <strong class="post_user_name">{{ $post->user->username }}</strong>
                            <span class="post_date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <p class="post_text">{!! nl2br(e($post->post)) !!}</p>
                    </div>
                </div>
            @empty
                <p class="empty_message">フォローしているユーザーの投稿がありません。</p>
            @endforelse
        </div>
    </main>
</x-login-layout>
