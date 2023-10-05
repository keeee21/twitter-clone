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
    public function detail(Request $request):View
    {
        $user = new User();
        $user_detail = $user->detail($request->route('id'));
        $this->authorize('view', $user_detail);
        
        return view('user.show',compact('user_detail'));
    }

    /**
     * ユーザー情報編集画面への移動
     *
     * @return View
     */
    public function edit():View
    {
        $user = Auth::user();

        return view('user.edit',compact('user'));
    }

    /**
     * ユーザー情報を編集
     *
     * @param UserEditRequest $request
     * @return RedirectResponse
     */
    public function update(UserEditRequest $request):RedirectResponse
    {
        $user = new User();
        $name = $request->name;
        $email = $request->email;
        $user->updateData($name,$email);

        return redirect()->route('user.detail',['id' => Auth::id()]);
    }

    /**
     * ユーザー情報を削除
     *
     * @return View
     */
    public function delete():View
    {
        $user = new User();
        $user->deleteByUserID(Auth::id());

        return view('welcome');
    }

    /**
     * ユーザー一覧の表示
     *
     * @return View
     */
    public function index():View
    {
        $user = new User();
        $users = $user->index();
        
        return view('user.index',compact('users'));
    }
}
