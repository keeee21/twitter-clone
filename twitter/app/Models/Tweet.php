<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    use HasFactory;

    /**
     * ツイート投稿作成機能
     *
     * @param string $tweet
     * @param int $user_id
     * @return void
     */
    public function create(string $tweet, int $user_id):void
    {
        $this->tweet = $tweet;
        $this->user_id = $user_id;
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
        return $this->with('user')->paginate(5);
    }
    
    /**
     * ツイート詳細表示
     *
     * @param int $tweet_id
     * @return Tweet
     */
    public function detail(int $tweet_id):Tweet
    {
        return $this->with('user')->find($tweet_id);
    }
}
