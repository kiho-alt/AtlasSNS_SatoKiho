<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(){
        return view('profiles.profile');
    }

    public function update(Request $request) {
    $user = Auth::user();

    $request->validate([
        'username'     => 'required|string|min:2|max:12',
        'email'        => ['required', 'string', 'email', 'min:5', 'max:40', Rule::unique('users')->ignore($user->id)],
        'new_password'              => 'required|alpha_num|min:8|max:20|confirmed',
        'new_password_confirmation' => 'required|alpha_num',
        'images'       => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
        'bio'          => 'nullable|string|max:150',
    ], [
        'username.required' => 'ユーザー名は必須項目です。',
        'username.min'      => 'ユーザー名は2文字以上で入力してください。',
        'username.max'      => 'ユーザー名は12文字以内で入力してください。',

        'email.required' => 'メールアドレスは必須項目です。',
        'email.min'      => 'メールアドレスは5文字以上で入力してください。',
        'email.max'      => 'メールアドレスは40文字以内で入力してください。',
        'email.email'    => '有効なメールアドレス形式で入力してください。',
        'email.unique'   => 'このメールアドレスは既に登録されています。',

        'new_password.required'  => 'パスワードは必須項目です。',
        'new_password.alpha_num' => 'パスワードは英数字のみで入力してください。',
        'new_password.min'       => 'パスワードは8文字以上で入力してください。',
        'new_password.max'       => 'パスワードは20文字以内で入力してください。',
        'new_password_confirmation.required'  => '確認用パスワードは必須項目です。',
        'new_password.confirmed' => 'パスワードが確認用と一致しません。',

        'images.mimes' => '画像の形式はjpg, png, bmp, gif, svgで登録してください。',
        'bio.max'      => '自己紹介は150文字以内で入力してください。',
    ]);

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->bio = $request->input('bio');

    //パスワードの更新：入力がある場合のみ
    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->input('new_password'));
    }

    //アイコン画像の更新：ファイルがある場合
    if ($request->hasFile('images')) {
        $old_image = $user->icon_image;
        if ($old_image !== 'icon1.png' && Storage::disk('public')->exists('icons/' . $old_image)) {
            Storage::disk('public')->delete('icons/' . $old_image);
        }

        $file = $request->file('images');
        $new_file_name = time() . '_' . Auth::id() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/icons', $new_file_name);
        $user->icon_image = $new_file_name;
    }

    $user->save();

    return redirect()->route('top');
}

    //他人のプロフィール情報取得
    public function userProfile($id){
    //URLのIDからそのユーザー情報を取得
    $user = User::findOrFail($id);
    //ユーザーの投稿一覧を取得
    $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    //Viewへ
    return view('users.userProfile', compact('user', 'posts'));
}
}
