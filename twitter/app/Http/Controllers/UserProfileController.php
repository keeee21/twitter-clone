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
     * @return view
     */
    public function index(): view
    {
        $users = User::paginate(10);
        return view('mypage.index', ['users' => $users]);
    }

    /**
     * ログインしているユーザーのマイページを表示します。
     *
     * @return view
     */
    public function show(): view
    {
        $loginUser = Auth::user();
        return view('mypage.show', compact('loginUser'));
    }

    /**
     * 名前・メールアドレスを更新
     *
     * @param  UserProfileRequest  $request
     * @return RedirectResponse
     */
    public function update(UserProfileRequest $request): RedirectResponse
    {
        $loginUser = Auth::user();
        $loginUser->updateProfile($request->only(['name', 'email']));

        return redirect()->route('mypage.show', $loginUser)->with('success', 'プロフィールを更新しました');
    }

    /**
     * ユーザー情報編集ページを表示
     *
     * @return View
     */
    public function edit(): View
        {
            $loginUser = Auth::user();
            return view('mypage.edit',compact('loginUser'));
        }

    /**
     *  現在のユーザーアカウントを削除
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        $loginUser = Auth::user();
        $loginUser->removeAccount();

        return redirect()->route('tweets.index')->with('success', 'アカウントを削除しました');
    }

}
