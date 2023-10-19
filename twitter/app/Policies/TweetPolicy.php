<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * ツイート編集時の認可
     *
     * @param User $user
     * @param Tweet $tweet
     * @return bool
     */
    public function update(User $user, Tweet $tweet):bool
    {
        return $user->id === $tweet->user_id;
    }

    /**
     * ツイート削除時の認可
     *
     * @param User $user
     * @param Tweet $tweet
     * @return bool
     */
    public function delete(User $user, Tweet $tweet):bool
    {
        return $user->id === $tweet->user_id;
    }
}
