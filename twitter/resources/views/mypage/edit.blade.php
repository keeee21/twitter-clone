@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $authUserMeta->name }}さんの情報を編集</h1>

    <form action="{{ route('mypage.update') }}" method="post">
        @csrf
        @method('PUT')

        <!-- 名前の編集フォーム -->
        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $authUserMeta->name) }}">
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- メールアドレスの編集フォーム -->
        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $authUserMeta->email) }}">
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>

    <br>

</div>
@endsection
