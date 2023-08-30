@extends('layouts.app')

@section('content')

    <!-- 作成フォーム -->
    <h1 class="mb-4 title-decorated display-7">ツイート作成</h1>

    @if(session('message'))
        <div class="alert {{ session('error') ? 'alert-danger' : 'alert-success' }}">
            {{ session('message') }}
        </div>
    @endif

    @error('content')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <form action="{{ route('tweets.store') }}" method="post">
        @csrf
        <textarea name="content" style="resize: none; width: 400px; height: 200px;"></textarea>
        <button type="submit">投稿する</button>
    </form>

    <br><br>

    <!-- 一覧表示 -->
    <h2>ツイート一覧</h2>
    <ul style="list-style-type: none;">
        @foreach($tweets as $tweet)
            <li style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
                {{ $tweet->content }}

                @if($authId === $tweet->user_id && auth()->check() && is_null(auth()->user()->deleted_at))
                    <a href="{{ route('tweets.edit', $tweet->id) }}">ツイートを編集する</a>

                    <!-- 削除フォーム -->
                    <form action="{{ route('tweets.destroy', $tweet->id) }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: red;">🗑️ 削除</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>

@endsection
