<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//==========ここから追加==========
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    //==========ここから追加==========
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
    //==========ここまで追加==========
    public function comments(): BelongsToMany
    {
        // ユーザーがコメントした記事を取得するメソッド
        // 第二引数で中間テーブルの名前を指定してあげる
        // ->withTimestampsを入力する事で、中間テーブルにも日付が反映される
        return $this->belongsToMany('App\User', 'comments')->withTimestamps();
    }

    // $article_id = 記事のid
    // userテーブルのユーザーidに紐づいた記事の取得？
    public function getArticle(Int $article_id)
    {
        return $this->with('user')->where('id', $article_id)->first();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}