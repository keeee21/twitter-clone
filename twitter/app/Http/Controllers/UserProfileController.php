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
        $authUserMeta = Auth::user();
        return view('mypage.show', compact('authUserMeta'));
    }

    /**
     * 名前・メールアドレスを更新
     *
     * @param  UserProfileRequest  $request
     * @return RedirectResponse
     */
    public function update(UserProfileRequest $request): RedirectResponse
    {
        $authUserMeta = Auth::user();
        $authUserMeta->updateProfile($request->only(['name', 'email']));

        return redirect()->route('mypage.show', $authUserMeta)->with('success', 'プロフィールを更新しました');
    }

    /**
     * ユーザー情報編集ページを表示
     *
     * @return View
     */
    public function edit(): View
    {
        $authUserMeta = Auth::user();
        return view('mypage.edit', compact('authUserMeta'));
    }

    /**
     *  現在のユーザーアカウントを削除
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        $authUserMeta = Auth::user();
        $authUserMeta->removeAccount();

        return redirect()->route('tweets.index')->with('success', 'アカウントを削除しました');
    }

    /**
     * ユーザーをフォローする
     *
     * @param int $userId
     * @return RedirectResponse
     */
    public function follow(int $userId): RedirectResponse
    {
        $userToFollow = User::findOrFail($userId);
        $authUser = Auth::user();

        $authUser->following()->attach($userToFollow);

        return redirect()->back()->with('success', 'ユーザーをフォローしました');
    }

    /**
     * ユーザーのフォローを解除する
     *
     * @param int $userId
     * @return RedirectResponse
     */
    public function unfollow(int $userId): RedirectResponse
    {
        $userToUnfollow = User::findOrFail($userId);
        $authUser = Auth::user();

        $authUser->following()->detach($userToUnfollow);

        return redirect()->back()->with('success', 'ユーザーのフォローを解除しました');
    }
}
