<?php

namespace App\Models;

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
    public function getTweetAll()
    {
        return $this->orderBy('created_at', 'desc')->get();
    }

    /**
     * 新しいツイートを作成
     *
     * @param string $content
     * @param int $userId
     * @return boolean
     */
    public function createTweetNew($content, $userId)
    {
        $this->content = $content;
        $this->user_id = $userId;
        return $this->save();
    }

    /**
     * ツイートを更新
     *
     * @param string $content 更新する内容
     * @return boolean 更新成功可否
     */
    public function updateTweet($content)
    {
        $this->content = $content;
        return $this->save();
    }

    /**
     * ツイートIDによってツイートを取得
     *
     * @param [int] $tweetId
     * @return Model
     */
    public function findTweetById($tweetId)
    {
        return $this->findOrFail($tweetId);
    }

    /**
     * ツイートが指定したユーザーによって所有されているかを確認
     *
     * @param [int] $userId
     * @return boolean
     */
    public function isOwnedBy($userId)
    {
        return $this->user_id == $userId;
    }

    /**
     * ユーザーIDに基づいてツイートを削除
     *
     * @param [int] $userId
     * @return boolean
     */
    public function deleteTweet($userId)
    {
        if ($this->user_id !== $userId) {
            return false;
        }

        return $this->delete();
    }
}
