@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <form method="post" action="{{ route('tweet.create') }}">
                            @csrf
                            <div class="card-text">
                                <input type="textarea" name="tweet">
                            </div>
                            <input type="submit" value="保存">
                        </form>
                        <form method="get" action="{{ route('home') }}">
                            @csrf
                            <input type="submit" value="キャンセル">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
