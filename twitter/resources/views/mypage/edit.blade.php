@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $loginUser->name }}さんの情報を編集</h1>

    <form action="{{ route('mypage.update', $loginUser->id) }}" method="post">
        @csrf
        @method('PUT')

        <!-- 名前の編集フォーム -->
        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $loginUser->name }}">
        </div>

        <!-- メールアドレスの編集フォーム -->
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $loginUser->email }}">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>

    <br>

</div>
@endsection
