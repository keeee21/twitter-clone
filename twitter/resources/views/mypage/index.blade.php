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
            <th>アクション</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td class="align-middle">
                @if(Auth::user()->following->contains($user->id))
                    <form action="{{ route('mypage.unfollow', $user->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-unfollow">フォロー中</button>
                    </form>
                @else
                    <form action="{{ route('mypage.follow', $user->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-follow">フォロー</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links('pagination::bootstrap-4') }}
@endsection
