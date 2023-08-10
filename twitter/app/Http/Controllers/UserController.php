<?php

// 自分がどこにいるのか
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SampleFormRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\View\View;
// use Auth;

class UserController extends Controller
{
    /**
     * 登録画面を表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.signup');
    }

    /**
     * ユーザーの新規登録
     *
     * @param  PostRequest  $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(PostRequest $request): RedirectResponse
    {   

        // ユーザーモデルインスタンスの作成
        $userModel = new User();
        
        // 新規ユーザーの登録
        $user = $userModel->register(
            $request->name,
            $request->email,
            $request->password
        );

        event(new Registered($user));
        // 登録後そのままログインするようにしている
        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        // URL指定はroute関数を使うと良い
        return redirect(route('home'));
    }

    /**
     * ユーザー一覧の表示
     *
     * @return View
     *
     */
    public function index(): View
    {
        $userModel = new User();

        // ユーザー一覧を取得して表示
        $users = $userModel->getAllUsers();
        return view('user.users', ['users' => $users]);
    }

    /**
     * マイページの表示
     *
     * @return View
     *
     */
    public function showMypage(): View
    {
        $userModel = new User();

        // ユーザーの情報を取得して表示
        $user = $userModel->getLoginUser();
        return view('user.show', ['user' => $user]);
    }

}