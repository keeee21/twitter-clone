@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @elseif(session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <p class="card-text">{{ $tweet->user->name }}</p>
                        <p class="card-text">{{ $tweet->tweet }}</p>
                        @if ($tweet->user_id == Auth::id())
                            <button onclick="location.href='{{ route('tweet.edit', $tweet->id) }}'">編集</button>
                        @endif
                        @if ($tweet->user_id == Auth::id())
                            <form method="post" action="{{ route('tweet.delete', $tweet->id) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="削除">
                            </form>
                        @endif
                        <form method="get" action="{{ route('tweet.index') }}">
                            <input type="submit" value="戻る">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
