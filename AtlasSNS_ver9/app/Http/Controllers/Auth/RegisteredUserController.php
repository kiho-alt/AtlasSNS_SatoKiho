<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //バリデーション
        $request->validate([
        'username' => 'required|string|min:2|max:12',
        'email' => 'required|string|email|min:5|max:40|unique:users',
        'password' => 'required|string|alpha_num|min:8|max:20|confirmed',
        'password_confirmation' => 'required|string|alpha_num',
    ],[
        'username.required' => 'ユーザー名は必須項目です。',
        'username.min'      => 'ユーザー名は2文字以上で入力してください。',
        'username.max'      => 'ユーザー名は12文字以内で入力してください。',

        'email.required' => 'メールアドレスは必須項目です。',
        'email.email'    => '有効なメールアドレス形式で入力してください。',
        'email.unique'   => 'このメールアドレスは既に登録されています。',
        'email.min'      => 'メールアドレスは5文字以上で入力してください。',
        'email.max'      => 'メールアドレスは40文字以内で入力してください。',

        'password.required'  => 'パスワードは必須項目です。',
        'password.alpha_num' => 'パスワードは英数字で入力してください。',
        'password.min'       => 'パスワードは8文字以上で入力してください。',
        'password.max'       => 'パスワードは20文字以内で入力してください。',

        'password.confirmed' => 'パスワードが確認用と一致しません。',
        'password_confirmation.required'  => 'パスワード（確認用）は必須項目です。',
        'password_confirmation.alpha_num' => 'パスワード（確認用）は英数字で入力してください。',
        ]);
        //バリデーションをを通過できたら、ユーザ作成処理実行
        $user = User::create([//←セッション書き込み用に変数に入れておく
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('added')->with('username', $user->username);;
        //usernameという名前でセッションにデータを書き込んみ次のaddedbladeに渡す
    }

    public function added(): View
    {
        // session('username') で受け取り、$usernameという名前でViewに渡す
        $username = session('username');

        return view('auth.added', compact('username'));
    }
}
