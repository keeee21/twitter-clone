<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TweetRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class TweetController extends Controller
{
    /**
     * ツイート一覧を表示
     *
     * @return View
     */
    public function index():View
    {
        $tweet = new Tweet();
        $tweets = $tweet->get();
        $authID = Auth::id();
        return view('tweets.index', ['tweets' => $tweets,'authId' => $authID]);
    }

    /**
     * ツイート作成画面を表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('tweets.create');
    }

    /**
     * 新しいツイートを保存
     *
     * @param TweetRequest  $request
     * @return RedirectResponse
     */
    public function store(TweetRequest $request): RedirectResponse
    {
        $tweet = new Tweet();
        $tweet->create($request->content, Auth::id());
        return redirect()->route('tweets.index');
    }

    /**
     * 指定したツイートを表示
     *
     * @param int $tweetId
     * @return view
     */
    public function show($tweetId): View
    {
        $tweet = new Tweet();
        $tweet = $tweet->findTweetById($tweetId);
        return view('tweets.show', ['tweet' => $tweet]);
    }

    /**
     * 指定したツイートを編集する画面を表示
     * @param int $tweetId
     * @return view
     */
    public function edit($tweetId): View
    {
        $tweet = (new Tweet())->findTweet($tweetId);
        $authId = Auth::id();
        // ユーザーがこのツイートのオーナーであることを確認する
        if (!$tweet->isOwnedBy($authId)) {
            return redirect()->route('tweets.index');
        }
        return view('tweets.edit', ['tweet' => $tweet]);
    }

    /**
     * 指定したツイートを更新
     *
     * @param  TweetRequest  $request
     * @param  int  $tweetId
     * @return RedirectResponse
     */
    public function update(TweetRequest $request, $tweetId):RedirectResponse
    {
        $tweet = new Tweet();
        $tweet = $tweet->findTweet($tweetId);

        // ユーザーがこのツイートのオーナーであることを確認する
        if (!$tweet->isOwnedBy(Auth::id())) {
            return redirect()->route('tweets.index');
        }

        $tweet->updateTweet($request->content);
        return redirect()->route('tweets.index')->with('message', 'ツイートの更新に成功しました!');
    }

    /**
     * 指定したツイートを削除
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function destroy($tweetId): RedirectResponse
    {
        $tweet = (new Tweet())->findTweet($tweetId);
        $authId = Auth::id();

    // ユーザーがこのツイートのオーナーであることを確認する
        if (!$tweet->deleteTweet($authId)) {
            return redirect()->route('tweets.index');
        }

        return redirect()->route('tweets.index')->with('message', 'ツイートが削除されました');
    }
}
