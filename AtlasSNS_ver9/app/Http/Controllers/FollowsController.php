<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class FollowsController extends Controller
{
    public function followerList()
{
    //モデルからフォロワー取得
    $followers = Auth::user()->followers;
    //フォロワーのIDリストを作成
    $follower_ids = $followers->pluck('id')->toArray();
    //フォロワーの投稿を取得（新しい順）
    $posts = Post::whereIn('user_id', $follower_ids)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('follows.followerList', compact('followers', 'posts'));
}
    public function followList()
{
    //フォローしてるユーザ取得
    $follows = Auth::user()->follows; //
    //IDリスト作成
    $follow_ids = $follows->pluck('id')->toArray();
    //投稿取得
    $posts = Post::whereIn('user_id', $follow_ids)
        ->orderBy('created_at', 'desc')
        ->get();
    //Viewに渡す
    return view('follows.followList', compact('follows', 'posts'));
}


    // フォローする
    public function follow(Int $user_id){
    $follower = Auth::user();
    // 相手をフォローとしてDBに追記
    $follower->follows()->attach($user_id);
    return back();
}
    // フォロー解除
    public function unfollow(Int $user_id){
    $follower = Auth::user();
    //フォローを外す（レコード削除）
    $follower->follows()->detach($user_id);
    return back();
}

}
