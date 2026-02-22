<x-login-layout>
    <main class="user_profile_main">
        <div class="user_profile_top">
            <div class="user_profile_icon_wrap">
                <img src="{{ $user->getIconPath() }}" alt="icon" class="icon">
            </div>

            <div class="user_profile_details">
                <div class="profile_row">
                    <span class="profile_label">ユーザー名</span>
                    <span class="profile_data">{{ $user->username }}</span>
                </div>
                <div class="profile_row">
                    <span class="profile_label">自己紹介</span>
                    <span class="profile_data">{{ $user->bio ?? '自己紹介はまだありません' }}</span>
                </div>
            </div>

            <div class="user_profile_action">
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

        <div class="timeline_divider"></div>

        <div class="post_list">
            @forelse($posts as $post)
                <div class="post_item">
                    <div class="post_icon_wrap">
                        <img src="{{ $user->getIconPath() }}" alt="icon" class="icon">
                    </div>
                    <div class="post_content">
                        <div class="post_header">
                            <span class="post_user_name">{{ $user->username }}</span>
                            <span class="post_date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="post_body">
                            <p class="post_text">{{ $post->post }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no_post">まだ投稿がありません。</p>
            @endforelse
        </div>
    </main>
</x-login-layout>
