<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * ツイート投稿作成機能
     *
     * @param string $tweetText
     * @param int $userId
     * @return void
     */
    public function create(string $tweetText, int $userId):void
    {
        $this->tweet = $tweetText;
        $this->user_id = $userId;
        $this->save();
    }

    /**
     * Get the user that owns the Tweet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ツイート一覧の表示
     *
     * @return LengthAwarePaginator
     */
    public function index():LengthAwarePaginator
    {
        return $this->with('user')->orderBy('updated_at', 'desc')->paginate(6);
    }
    
    /**
     * ツイート詳細表示
     *
     * @param int $tweetId
     * @return Tweet
     */
    public function detail(int $tweetId):Tweet
    {
        return $this->with('user')->find($tweetId);
    }

    /**
     * ツイートを更新
     *
     * @param integer $tweetId
     * @param string $tweetText
     * @return Tweet
     */
    public function updateTweet(int $tweetId, string $tweetText):Tweet
    {
        $tweet = Tweet::find($tweetId);
        $tweet->tweet = $tweetText;
        $tweet->update();

        return $tweet;
    }

    /**
     * ツイート削除機能
     *
     * @param integer $tweetId
     * @return void
     */
    public function deleteByTweetId(int $tweetId):void
    {
        Tweet::find($tweetId)->delete();
    }
}
