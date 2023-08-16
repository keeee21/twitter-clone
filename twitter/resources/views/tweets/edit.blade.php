@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ツイートを編集</h1>
        <form action="{{ route('tweets.update', $tweet->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Content:</label>
                <input type="text" class="form-control" name="content" id="content" value="{{ $tweet->content }}">
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">編集する</button>
        </form>
    </div>
@endsection
