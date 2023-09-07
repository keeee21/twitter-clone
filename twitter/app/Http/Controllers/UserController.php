<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // ユーザー詳細
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // ユーザーが見つからない場合は404エラーを表示
        }

        return view('users.show', compact('user'));
    }
}
