<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * インスタンスの生成
     *
     * @var [User]
     */
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * ユーザー詳細画面を表示します。
     *
     * @param string $id
     * @return RedirectResponse|View
     */
    public function findByUserId(string $id):RedirectResponse|View
    {
        if(Auth::id() !== (int)$id){
            return redirect()->route('top');
        }
        $user = $this->user->findByUserId($id);
        return view('user.show',compact('user'));
    }
}
