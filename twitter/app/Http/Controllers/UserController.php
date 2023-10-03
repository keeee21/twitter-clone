<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
}
