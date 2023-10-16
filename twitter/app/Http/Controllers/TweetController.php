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
    public function edit(int $tweet_id):View|RedirectResponse
    {
        $tweets = new Tweet();
        $tweet = $tweets->detail($tweet_id);

        if ($tweet->user_id == Auth::id()) {
            return view('tweet.edit', compact('tweet'));
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
            $tweets = new Tweet();
            $tweet_id = $request->id;
            $tweet = $request->tweet;
            $tweet = $tweets->updateData($tweet_id, $tweet);
            DB::commit();

            return redirect()->route('tweet.detail', $tweet_id)->with('success', '更新しました！');
        } catch(\Exception $e) {
            Log::error($e);
            DB::rollback();
            
            return redirect()->route('tweet.detail', $tweet_id)->with('error', '更新中にエラーが発生しました！');
        }
    }

    /**
     * ツイートの削除
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request):RedirectResponse
    {
        try {
            DB::beginTransaction();
            $tweet = new Tweet();
            $tweet_id = $request->id;
            $tweet->deleteByTweetId($tweet_id);
            DB::commit();

            return redirect()->route('tweet.index')->with('success', '削除しました！');
        } catch(\Exception $e) {
            Log::error($e);
            DB::rollback();
            
            return redirect()->route('tweet.index')->with('error', '削除に失敗しました！');
        }
    }
}
