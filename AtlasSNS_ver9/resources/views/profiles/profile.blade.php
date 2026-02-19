<x-login-layout>
    <main id="profileContainer">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="error_message_container">
                <ul class="error_list">
                    @foreach ($errors->all() as $error)
                        <li class="error_message_area">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data" class="profile_form">
            @csrf

            <div class="profile_item_wrapper">
                <div class="profile_icon_current_wrap">
                    <img src="{{ Auth::user()->getIconPath() }}" alt="icon" class="icon">
                </div>

                <div class="profile_fields_list">
                    <div class="profile_field_row">
                        <label class="field_label">ユーザー名</label>
                        <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="field_input">
                    </div>

                    <div class="profile_field_row">
                        <label class="field_label">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="field_input">
                    </div>

                    <div class="profile_field_row">
                        <label class="field_label">パスワード</label>
                        <input type="password" name="new_password" placeholder="●●●●●●●●" class="field_input">
                    </div>

                    <div class="profile_field_row">
                        <label class="field_label">パスワード確認</label>
                        <input type="password" name="new_password_confirmation" placeholder="●●●●●●●●" class="field_input">
                    </div>

                    <div class="profile_field_row">
                        <label class="field_label">自己紹介</label>
                        <textarea name="bio" rows="2" class="field_textarea">{{ old('bio', Auth::user()->bio) }}</textarea>
                    </div>

                    <div class="profile_field_row">
                        <label class="field_label">アイコン画像</label>
                        <div class="file_upload_area">
                            <input type="file" name="images" id="iconUpload" class="field_file">
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile_submit_area">
                <button type="submit" class="btn_update">更新</button>
            </div>
        </form>
    </main>
</x-login-layout>
