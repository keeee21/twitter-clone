<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tweet extends Model
{
    use HasFactory;

    /**
     * ユーザーデーブルとリレーションをはる
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * ツイートをtweetsテーブルに保存する
     */
    public function saveTweet(Request $request): void
    {
        $this->tweet = $request->tweet;
        $this->user_id = $request->user()->id;
        $this->save();
    }

    /**
     * 全てのツイートを取得する。
     */
    public function getAllTweets(): Collection
    {
        return Tweet::all()->sortByDesc('created_at');
    }

    /**
     * 特定のツイートを取得する。
     */
    public function findByTweetId(int $tweetId): Tweet
    {
        $tweet = new Tweet();
        $tweetDetail = $tweet->find($tweetId);
        if (is_null($tweetDetail)) abort(404);

        return $tweet->find($tweetId);
    }

    /**
     * ツイート内容の更新
     */
    public function updateTweet(int $tweetId, Request $request): void
    {
        $tweetInfo = $this->findByTweetId($tweetId);
        $tweetInfo->tweet = $request->tweet;
        $tweetInfo->save();
    }
}
