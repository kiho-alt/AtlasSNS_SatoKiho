<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;


//未ログイン状態でアクセス可能
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');//ログインフォーム
    Route::post('login', [AuthenticatedSessionController::class, 'store']);//ログイン（処理のみ）
    Route::get('register', [RegisteredUserController::class, 'create']);//登録フォーム
    Route::post('register', [RegisteredUserController::class, 'store']);//登録内容入れ込み（処理のみ）
    Route::get('added', [RegisteredUserController::class, 'added']);//登録完了画面表示
});

//パスワードリセット系
Route::get('reset-password', [NewPasswordController::class, 'create']);//初期パスワード変更フォーム
Route::get('reset', [NewPasswordController::class, 'store']);//初期パスワード変更（処理のみ）
Route::get('forgot-password', [PasswordResetLinkController::class, 'create']);//パスワード再設定フォーム
Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);//パスワード更新（処理のみ）
