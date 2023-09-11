<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * マイページの表示
     *
     * @return View
     *
     */
    public function findByUserId($id): View
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }
}
