<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{

public function index()
    {
        //followsテーブルからfollowed_idだけを抜き出し
        $following_ids = Auth::user()->follows()->pluck('followed_id')->toArray();

        //自分のIDも
        $following_ids[] = Auth::id();

        //リスト上記のリストに合致する投稿だけDBからもってくる
        $posts = Post::whereIn('user_id', $following_ids)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        //格納済み$postsをViewに渡す
        return view('posts.index', compact('posts'));
    }

public function create(Request $request)
    {
        //バリデーション
        $request->validate([
            'new_post' => 'required|string|min:1|max:150',
        ], [
        'new_post.required' => '投稿内容を入力してください。',
        'new_post.max'      => '投稿は150文字以内で入力してください',
    ]);

        //DBへかきこみ
        Post::create([
            'user_id' => Auth::id(),
            'post'    => $request->input('new_post'),
        ]);

        return redirect()->route('top');
    }

//投稿編集（モーダル）
public function update(Request $request)
    {
        $request->validate([
            'up_post' => 'required|string|min:1|max:150',
        ], [
            'up_post.required' => '更新内容は必須項目です。',
            'up_post.max'      => '投稿は150文字以内で入力してください。',
        ]);

        $post_id = $request->input('id');
        $up_post = $request->input('up_post');

        Post::where('id', $post_id)
            ->where('user_id', Auth::id())
            ->update([
                'post' => $up_post
            ]);

        return redirect()->route('top');
    }

//投稿削除
public function delete($id)
    {
        //指定されたIDの投稿を削除
        Post::where('id', $id)
            ->where('user_id', \Auth::id())
            ->delete();

        return redirect('/top');
    }
}
