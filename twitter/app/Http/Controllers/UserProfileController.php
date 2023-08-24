<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserProfileController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * マイページを表示します。
     *
     * @return view
     */
    public function show(): view
    {
        $authId = Auth::id();
        $user = Auth::user();
        return view('mypage.show', compact('user'));
    }

    /**
     * 名前・メールアドレスを更新
     *
     * @param  UserProfileRequest  $request
     * @return RedirectResponse
     */
    public function update(UserProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->updateProfile($request->only(['name', 'email']));

        return redirect()->route('mypage.show', $user)->with('success', 'プロフィールを更新しました');
    }

    /**
     *  現在のユーザーアカウントを削除
     *
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        $authId = Auth::id();
        $user = Auth::user();
        $user->removeAccount();

        return redirect()->route('tweets.index')->with('success', 'アカウントを削除しました');
    }


}
