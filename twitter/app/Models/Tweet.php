<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function create(string $tweet, int $user_id)
    {
        $this->tweet = $tweet;
        $this->user_id = $user_id;
        $this->save();
    }
}
