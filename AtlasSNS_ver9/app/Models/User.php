<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'icon_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //今のアイコンのパスを返す専用メソッド
    public function getIconPath()
    {
        //初期画像名かチェック
        if (str_contains($this->icon_image, 'icon1.png')) {
        return asset('images/icon1.png');
    }
        //それ以外はstorageフォルダ直下を参照
        return asset('storage/icons/' . $this->icon_image);
    }

    public function follows(){
    //フォロー情報のリレーション
    return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }
    //フォロワー情報もおなじく。
    public function followers(){
    return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }
    public function posts(){
    return $this->hasMany(Post::class);
}

    public function isFollowing(Int $user_id){
    // フォロー中かそうでないかを判定
    // 自分のfollowsの中に相手のIDが含まれているかみる
    return $this->follows()->where('followed_id', $user_id)->exists();
}
}
