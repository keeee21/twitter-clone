<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TweetRequest;

class TweetController extends Controller
{
    /**
     * ツイート一覧を表示
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tweets = Tweet::orderBy('created_at', 'desc')->get();
        return view('tweets.index', ['tweets' => $tweets]);
    }

    /**
     * ツイート作成画面を表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tweets.create');
    }

    /**
     * 新しいツイートを保存
     *
     * @param \App\Http\Requests\TweetRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TweetRequest $request)
    {
        $tweet = new Tweet;
        $tweet->content = $request->content;
        $tweet->user_id = Auth::id();
        $tweet->save();

        return redirect()->route('tweets.index');
    }

    /**
     * 指定したツイートを表示
     *
     * @param [int] $id
     * @return view
     */
    public function show($id)
    {
        $tweet = Tweet::findOrFail($id);
        return view('tweets.show', ['tweet' => $tweet]);
    }

    /**
     * 指定したツイートを編集する画面を表示
     *
     * @param  [int] $id
     * @return redirect view
     * @return view
     */
    public function edit($id)
    {
        $tweet = Tweet::findOrFail($id);

        // ユーザーがこのツイートのオーナーであることを確認する
        if (Auth::id() !== $tweet->user_id) {
            return redirect()->route('tweets.index')->withErrors('このツイートを編集する権限を持っていません');
        }

        return view('tweets.edit', ['tweet' => $tweet]);
    }

    /**
     * 指定したツイートを更新
     *
     * @param  \App\Http\Requests\TweetRequest  $request
     * @param  [int]  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TweetRequest $request, $id)
    {
        $tweet = Tweet::findOrFail($id);

        // ユーザーがこのツイートのオーナーであることを確認する
        if (Auth::id() !== $tweet->user_id) {
            return redirect()->route('tweets.index')->withErrors('このツイートを編集する権限を持っていません');
        }

        $tweet->content = $request->content;
        $tweet->save();
        return redirect()->route('tweets.index')->with('message', 'ツイートの更新に成功しました!');
    }

    /**
     * 指定したツイートを削除
     *
     * @param  [int]$id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tweet = Tweet::findOrFail($id);

        // ユーザーがこのツイートのオーナーであることを確認する
        if (Auth::id() !== $tweet->user_id) {
            return redirect()->route('tweets.index')->withErrors('このツイートを編集する権限を持っていません');
        }

        $tweet->delete();
        return redirect()->route('tweets.index')->with('ツイートが削除されました');
    }
}
