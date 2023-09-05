@extends('layouts.app')

@section('content')
<div class="container">
    <h2>フォロワー</h2>
    <ul class="list-group">
        @foreach($users as $user)
        <li class="list-group-item">
            {{ $user->name }}
        </li>
        @endforeach
    </ul>
    @if($users->count())
        {{ $users->links() }}
    @endif
</div>
@endsection
