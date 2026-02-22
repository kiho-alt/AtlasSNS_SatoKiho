<x-login-layout>
    <main class="main_container">
        <div class="post_form_container">
            <img src="{{ Auth::user()->getIconPath() }}" alt="icon" class="icon">

            <form action="{{ route('post.create') }}" method="POST" class="post_form" novalidate>
                @csrf
                <div class="post_input_group">
                    <textarea name="new_post" class="post_textarea" placeholder="投稿内容を入力してください" rows="4"></textarea>

                    @error('new_post')
                        <div class="error_message_area">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <div class="post_submit_wrap">
                    <button type="submit" class="btn_post_submit">
                        <img src="{{ asset('images/post.png') }}" alt="投稿" class="post_submit_img">
                    </button>
                </div>
            </form>
        </div>

        <div class="timeline">
            @foreach($posts as $post)
                <div class="post_item">
                    <img src="{{ $post->user->getIconPath() }}" alt="icon" class="icon">

                    <div class="post_content">
                        <div class="post_header">
                            <span class="post_user_name">{{ $post->user->username }}</span>
                            <span class="post_date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                        </div>

                        <p class="post_text">{!! nl2br(e($post->post)) !!}</p>

                        @if($post->user_id === Auth::id())
                            <div class="post_button_group">
                                <a href="" class="js-modal-open" post="{{ $post->post }}" post_id="{{ $post->id }}">
                                    <div class="action_icon_wrap">
                                        <img src="{{ asset('images/edit.png') }}" alt="編集" class="post_icon_normal">
                                        <img src="{{ asset('images/edit_h.png') }}" alt="編集" class="post_icon_hover">
                                    </div>
                                </a>

                                <a href="{{ route('post.delete', ['id' => $post->id]) }}" class="js-modal-delete-open">
                                    <div class="action_icon_wrap">
                                        <img src="{{ asset('images/trash.png') }}" alt="削除" class="post_icon_normal">
                                        <img src="{{ asset('images/trash-h.png') }}" alt="削除" class="post_icon_hover">
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal js-modal">
            <div class="modal_bg js-modal-close"></div>
            <div class="modal_content">
                <form action="{{ route('post.update') }}" method="POST">
                    @csrf
                    <textarea name="up_post" class="modal_post modal_post_textarea">@if($errors->has('up_post')){{ old('up_post') }}@endif</textarea>
                    <input type="hidden" name="id" class="modal_id" value="@if($errors->has('up_post')){{ old('id') }}@endif">

                    @if ($errors->has('up_post'))
                        <div class="error_message_area">
                            <p class="error_message">{{ $errors->first('up_post') }}</p>
                        </div>
                    @endif

                    <div class="modal_submit_area">
                        <button type="submit" class="btn_modal_submit">
                            <div class="modal_submit_img_wrap">
                                <img src="{{ asset('images/edit.png') }}" alt="更新" class="modal_submit_img">
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal js-modal-delete">
            <div class="modal_bg js-modal-close"></div>
            <div class="modal_content_delete">
                <p class="delete_confirm_text">この投稿を削除します。よろしいでしょうか？</p>
                <div class="delete_button_area">
                    <a class="btn-real-delete btn_real_delete" href="">OK</a>
                    <a class="js-modal-close btn_cancel" href="">キャンセル</a>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if ($errors->has('up_post'))
                    // ページ構成が読み込まれた直後に、強制的にモーダルを表示
                    var editModal = document.querySelector('.js-modal');
                    if (editModal) {
                        editModal.style.display = 'block';
                    }
                @endif
            });
        </script>
    </main>
</x-login-layout>
