<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function tweet(){
        return view('tweet.create');
    }
    
    public function create(){
        //
    }
}
