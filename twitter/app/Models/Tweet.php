<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tweet extends Model
{
    protected $fillable = ['content', 'user_id'];

    public static function createTweet($content, $userId)
    {
        return self::create([
            'content' => $content,
            'user_id' => $userId
        ]);
    }

    public function updateTweet($content)
    {
        $this->content = $content;
        return $this->save();
    }

    use HasFactory;
}
