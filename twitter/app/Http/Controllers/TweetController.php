<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TweetController extends Controller
{
    /**
     * ツイート投稿ページ表示
     *
     * @return View
     */
    public function tweet():View
    {
        return view('tweet.create');
    }
    
    /**
     * ツイート投稿作成機能
     *
     * @param CreateTweetRequest $request
     * @return View
     */
    public function create(CreateTweetRequest $request):View
    {
        $tweets = new Tweet();
        $tweet = $request->tweet;
        $user_id = Auth::id();
        $tweets->create($tweet,$user_id);

        return view('home');
    }

    /**
     * ツイート一覧表示
     *
     * @return View
     */
    public function index():View
    {
        $tweets = new Tweet();
        $tweets = $tweets->index();
        
        return view('tweet.index',compact('tweets'));
    }
}
