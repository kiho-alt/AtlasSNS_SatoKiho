<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

//ログイン中（auth）のみアクセス可
Route::middleware('auth')->group(function () {
    Route::get('top', [PostsController::class, 'index'])->name('top');//ホーム画面
    Route::get('profile', [ProfileController::class, 'profile']);//プロフィール画面
    Route::get('search', [UsersController::class, 'search'])->name('search');//検索画面表示
    Route::get('followList', [FollowsController::class, 'followList'])->name('followList');
    Route::get('followerList', [FollowsController::class, 'followerList'])->name('followerList');

    // ログアウト処理
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');;

    // プロフィール画像更新処理
    Route::post('profile', [ProfileController::class, 'update'])->name('profile');

    //検索情報取得処理
    Route::get('search', [UsersController::class, 'search'])->name('user.search');

    //フォローボタン処理
    Route::post('/follow/{id}', [FollowsController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{id}', [FollowsController::class, 'unfollow'])->name('unfollow');

    // フォロワー＆フォローリスト表示
    Route::get('/follower-list', [FollowsController::class, 'followerList'])->name('follower.list');
    Route::get('/follow-list', [FollowsController::class, 'followList'])->name('follow.list');

    // 他人のプロフィール表示（{id}で誰のページか指定する）
    Route::get('/profile/{id}', [ProfileController::class, 'userProfile'])->name('user.profile');

    //投稿用
    Route::post('/post/create', [PostsController::class, 'create'])->name('post.create');
    //削除用
    Route::get('/post/delete/{id}', [PostsController::class, 'delete'])->name('post.delete');
    //編集用
    Route::post('/post/update', [PostsController::class, 'update'])->name('post.update');
});
