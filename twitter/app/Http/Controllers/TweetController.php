<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function tweet(){
        return view('tweet.create');
    }
    
    public function create(Request $request)
    {
        $tweets = new Tweet();
        $tweet = $request->tweet;
        $user_id = Auth::id();
        $tweets->create($tweet,$user_id);

        return view('home');
    }
}
