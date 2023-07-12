@extends('layouts.app')
@section('content')

<body>
    <h1>ユーザー一覧</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">名前</th>
                    <th scope="col">メールアドレス</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
@endsection