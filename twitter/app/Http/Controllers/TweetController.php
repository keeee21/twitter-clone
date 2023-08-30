<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Tweet;
// use App\Models\User;
use App\Http\Requests\TweetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class TweetController extends Controller
{
    /**
     * ツイート画面を表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('tweet.tweet');
    }

    /**
     * ツイートを登録
     *
     * @param TweetRequest $request
     * @return RedirectResponse
     */
    public function store(TweetRequest $request): RedirectResponse
    {   
        // ツイートモデルインスタンスの作成
        $tweetModel = new Tweet();
        
        // 新規ツイートの登録
        $tweetModel->store($request->tweet);

        // TODO：ツイート一覧にリダイレクトするようにする
        return redirect(route('home'));
    }

    /**
     * ツイート一覧の表示
     *
     * @return View
     *
     */
    public function index(): View
    {
        $tweetModel = new Tweet();
        // $userModel = new User();

        // ツイート一覧を取得して表示
        $tweets = $tweetModel->getAllTweets();

        // $users = $userModel->getAllUsers();
        
        return view('tweet.list', ['tweets' => $tweets]);

        // return view('tweet.list', ['tweets' => $tweets, 'users' => $users]);
    }

}
