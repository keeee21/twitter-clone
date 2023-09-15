<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    // findByUserIdメソッド：モデルへIDを送り、得られたユーザー情報をビューへ送る
    public function findByUserId(Request $request){
        //dd($id);
        //処理
        $user = new User();
        $user_detail = $user->findByUserId($request->route('id'));
        //認可
        $this->authorize('view', $user_detail);
        
        return view('user/show',['user_detail' => $user_detail]);
    }
}
