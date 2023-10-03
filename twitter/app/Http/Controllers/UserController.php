<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        
        return view('user/show',compact('user_detail'));
    }

    /**
     * ユーザー一覧の表示
     *
     * @return View
     */
    public function getAll():View
    {
        $user = new User();
        $users = $user->getAll();
        //dd($users);
        
        return view('user/index',compact('users'));
    }
}
