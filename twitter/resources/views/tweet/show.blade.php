@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">ツイート詳細</h5>
                        <p class="card-text">ユーザー名：{{ $tweet->user->name }}</p>
                        <p class="card-text">ツイート内容：{{ $tweet->tweet }}</p>
                        <form method="get" action="{{ route('tweet.edit') }}">
                            <input type="submit" value="編集">
                        </form>
                        <form method="get" action="{{ route('tweet.index') }}">
                            <input type="submit" value="戻る">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
