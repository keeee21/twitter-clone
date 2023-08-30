@extends('layouts.app')

@section('content')

<h1 class="mb-4 title-decorated display-7">マイページ</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- ユーザー情報の表示 -->
<div class="card mb-4">
    <div class="card-header">
        プロフィール情報
    </div>
    <div class="card-body">
        <p><strong>名前:</strong> {{ $loginUserId->name }}</p>
        <p><strong>メールアドレス:</strong> {{ $loginUserId->email }}</p>
        <p><strong>アカウント制作日:</strong> {{ $loginUserId->created_at }}</p>
    </div>
</div>

<div class="d-flex align-items-center">
    <!-- btn-customクラスを追加 -->
    <a href="{{ route('mypage.edit') }}" class="btn btn-primary btn-custom mb-3">ユーザー情報を編集</a>

    <form method="POST" action="{{ route('mypage.destroy', ['userId' => $loginUserId->id]) }}" onsubmit="
    return confirm('⚠️本当にアカウントを削除してもよろしいですか？⚠️');">
        @csrf
        @method('DELETE')
        <!-- btn-customクラスを追加 -->
        <button type="submit" class="btn btn-danger btn-custom mb-3">アカウントを削除する</button>
    </form>

    <!-- btn-customクラスを追加 -->
    <a href="{{ route('tweets.index') }}" class="btn btn-success btn-custom mb-3">ツイート一覧に戻る</a>
</div>

@endsection
