<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserProfileController extends Controller
{
    /**
     * マイページを表示します。
     *
     * @return view
     */
    public function show(): view
    {
        $authID = Auth::id();
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
        $authID = Auth::id();
        $user = Auth::user();
        $user->removeAccount();

        return redirect()->route('tweets.index')->with('success', 'アカウントを削除しました');
    }

    
}
