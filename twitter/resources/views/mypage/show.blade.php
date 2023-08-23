@extends('layouts.app')
@section('content')

<h1>マイページ</h1>

<form method="POST" action="{{ route('mypage.update', ['mypage' => $user->id]) }}">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @csrf
    @method('PUT')
    <div>
        <label>名前:</label>
        <input type="text" name="name" >
        @error('name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <label>メールアドレス:</label>
        <input type="email" name="email" >
        @error('email')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit">更新する</button>
</form>

<br>

<form method="POST" action="{{ route('mypage.destroy', ['mypage' => $user->id]) }}"
    onsubmit="return confirm('⚠️本当にアカウントを削除してもよろしいですか？⚠️');">
    @csrf
    @method('DELETE')
    <button type="submit">アカウントを削除する</button>
</form>

@endsection
