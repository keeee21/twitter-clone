<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTweetRequest;
use App\Http\Requests\UpdateTweetRequest;
use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
     * @return RedirectResponse
     */
    public function create(CreateTweetRequest $request):RedirectResponse
    {
        $tweets = new Tweet();
        $tweet = $request->tweet;
        $user_id = Auth::id();
        $tweets->create($tweet,$user_id);

        return redirect('home');
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

    /**
     * ツイート詳細表示
     *
     * @param Request $request
     * @return View
     */
    public function detail(int $tweet_id):View
    {
        $tweets = new Tweet();
        $tweet = $tweets->detail($tweet_id);

        return view('tweet.show', compact('tweet'));
    }

    /**
     * ツイート編集画面の表示
     *
     * @return View|RedirectResponse
     */
    public function edit(int $tweet_id, Tweet $tweet):View|RedirectResponse
    {
        $tweet_text = $tweet->detail($tweet_id);
        $boolFlag = false;
        if($tweet_text->user_id === Auth::id()) $boolFlag = true;

        if ($boolFlag) {
            return view('tweet.edit', compact('tweet_text'));
        } else {
            return redirect()->route('tweet.detail', $tweet_id)->with('message', '他のユーザーのツイートを編集できません！！！');
        };
    }

    /**
     * ツイート編集
     *
     * @param UpdateTweetRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateTweetRequest $request):RedirectResponse
    {
        try {
            DB::beginTransaction();
            $tweet = new Tweet();
            $tweet_id = $request->id;
            $tweet_text = $request->tweet;
            $tweet = $tweet->updateTweet($tweet_id, $tweet_text);
            DB::commit();

            return redirect()->route('tweet.detail', $tweet_id)->with('success', '更新しました！');
        } catch(\Exception $e) {
            Log::error($e);
            DB::rollback();
            
            return redirect()->route('tweet.detail', $tweet_id)->with('error', '更新中にエラーが発生しました！');
        }
    }
}
