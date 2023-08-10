@extends('layouts.app')

@section('content')



    <!-- 作成フォーム -->
    <h1>ツイート作成</h1>

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
    <h2>一覧</h2>
    <ul style="list-style-type: none;">
        @foreach($tweets as $tweet)
            <li style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
                {{ $tweet->content }}
                @if(Auth::id() === $tweet->user_id)
                    <a href="{{ route('tweets.edit', $tweet->id) }}">ツイートを編集する</a>
                @endif

                <!-- 削除フォーム -->
                @if(Auth::id() === $tweet->user_id)
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
