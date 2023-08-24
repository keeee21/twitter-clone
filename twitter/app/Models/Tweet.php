<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    /**
     * 全てのツイートを作成日時の降順で取得
     *
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->orderBy('created_at', 'desc')->get();
    }

    /**
     * 新しいツイートを作成
     *
     * @param string $content
     * @param int $userId
     */
    public function createNewTweet($content, $userId)
    {
        $this->content = $content;
        $this->user_id = $userId;
        $this->save();
    }

    /**
     * ツイートを更新
     *
     * @param string $content
     * @return boolean
     */
    public function updateTweet($content): bool
    {
        $this->content = $content;
        return $this->save();
    }

    /**
     * ツイートIDによってツイートを取得
     *
     * @param int $tweetId
     * @return Tweet
     */
    public function findByTweetId(int $tweetId): Tweet
    {
        $tweet = $this->find($tweetId);
        return $tweet;
    }

    /**
     * ツイートが指定したユーザーによって所有されているかを確認
     *
     * @param int $userId
     * @return boolean
     */
    public function isOwnedBy(int $userId): bool
    {
        return $this->user_id == $userId;
    }

    /**
     * ユーザーIDに基づいてツイートを削除
     *
     * @param int $tweetId
     */
    public function deleteByTweetId($tweetId)
    {
        $tweet = $this->find($tweetId);
        $tweet->delete();
    }

}
