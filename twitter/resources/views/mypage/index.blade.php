@extends('layouts.app')

@section('content')
<h1 class="mb-4 title-decorated display-7">ユーザー一覧</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>アカウント制作日</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links('pagination::bootstrap-4') }}
@endsection
