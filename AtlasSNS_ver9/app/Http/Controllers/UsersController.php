<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    // public function search(){
    //     return view('users.search');
    // }


    // 検索機能処理
    public function search(Request $request)
{
    //検索窓に入力された値を取得
    $keyword = $request->input('keyword');
    //自分以外の全ユーザーを選択
    $query = User::where('id', '!=', Auth::id());

    if (!empty($keyword)) {
        $query->where('username', 'LIKE', "%{$keyword}%");
        //検索ワードがあれば、名前の部分一致で絞り込み
    }
    //結果取得
    $users = $query->get();
    //検索ワードと共にViewへ
    return view('users.search', compact('users', 'keyword'));
}

}
