<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    /**
     * トップ画面を表示
     *
     * @return View
     */
    public function index() {
        return view('top.index');
    }
}
