<?php

namespace App\Models;

use Exception;
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
    public function create($content, $userId)
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
     * @param int $loginUserId
     * @return Tweet
     */
    public function findTweet(int $tweetId): Tweet
    {
        $tweet = $this->find($tweetId);

        if (!$tweet) {
            throw new Exception('TweetNotFoundException');
        }

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
     * @param int $userId
     * @return boolean
     */
    public function deleteTweet($userId)
    {
        if (!$this->isOwnedBy($userId)) {
            return false;
        }

        $this->delete();
        return true;
    }
}
