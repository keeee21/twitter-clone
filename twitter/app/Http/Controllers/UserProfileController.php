<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserProfileController extends Controller
{
    /**
     * ユーザー一覧ページを表示する
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::paginate(10);
        return view('mypage.index', ['users' => $users]);
    }

    /**
     * ログインしているユーザーのマイページを表示します。
     *
     * @return View
     */
    public function show(): View
    {
        $loginUserId = Auth::user();
        return view('mypage.show', compact('loginUserId'));
    }

    /**
     * 名前・メールアドレスを更新
     *
     * @param  UserProfileRequest  $request
     * @return RedirectResponse
     */
    public function update(UserProfileRequest $request): RedirectResponse
    {
        $loginUserId = Auth::user();
        $loginUserId->updateProfile($request->only(['name', 'email']));

        return redirect()->route('mypage.show', $loginUserId)->with('success', 'プロフィールを更新しました');
    }

    /**
     * ユーザー情報編集ページを表示
     *
     * @return View
     */
    public function edit(): View
    {
        $loginUserId = Auth::user();
        return view('mypage.edit', compact('loginUserId'));
    }


    /**
     *  現在のユーザーアカウントを削除
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        $loginUserId = Auth::user();
        $loginUserId->removeAccount();

        return redirect()->route('tweets.index')->with('success', 'アカウントを削除しました');
    }

}
