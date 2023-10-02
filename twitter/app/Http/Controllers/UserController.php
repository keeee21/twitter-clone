<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    
    /**
     * ユーザー詳細情報を取得
     *
     * @param Request $request
     * @return View
     */
    public function findByUserId(Request $request):View
    {
        $user = new User();
        $user_detail = $user->findByUserId($request->route('id'));
        $this->authorize('view', $user_detail);
        
        return view('user/show',['user_detail' => $user_detail]);
    }
    /**
     * ユーザー情報編集画面への移動
     *
     * @return View
     */
    public function userEditPageDisplay():View
    {
        $user = Auth::user();

        return view('user/edit',compact('user'));
    }
    /**
     * ユーザー情報編集
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(UserEditRequest $request):RedirectResponse
    {
        $user = new User();
        $user->userEdit($request);

        return redirect()->route('show',['id' => Auth::id()]);
    }
}
