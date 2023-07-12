@extends('layouts.app')
@section('content')

<body>
    <h1>ツイート一覧</h1>
    @foreach ($allTweets as $tweet)
    <a class="text-decoration-none tweet-card-link" href="{{ route('tweets.show', ['id' => $tweet->id]) }}">

        <div class="card tweet-card text-dark bg-light mb-3">
            <div class="card-body">
                <p class="card-title fw-bolder">{{ $tweet->user->name}}<span class="text-secondary">{{ $tweet->created_at }}</span></p>
                <p class="card-text">
                    {{ $tweet->tweet }}
                    @if ($tweet->updated_at != $tweet->created_at)
                    <small class="text-secondary">（編集済み）</small>
                    @endif
                </p>
            </div>
            @if (Auth::id() === $tweet->user->id)
            <div class="tweet-dropdown">
                <a class="dots-leader" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="true">
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#test-modal-{{ $tweet->id }}" href="#">編集する</a></li>
                    <li><a class="dropdown-item text-danger" href="#">削除する</a></li>
                </ul>
            </div>
            <div id="test-modal-{{ $tweet->id }}" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content update-modal">
                        <div class="modal-header">
                            <h5 class="modal-title">ツイート編集</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="update-{{ $tweet->id }}" method="POST" action="{{ route('tweets.update', $tweet->id) }}">
                                @csrf
                                <textarea class="tweet-textarea" type="text" id="tweet" name="tweet">{{ $tweet->tweet }}</textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                            <button type="submit" form="update-{{ $tweet->id }}" class="btn btn-primary" data-bs-dismiss="modal">更新する</button>
                        </div>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </a>
        @endforeach
</body>
@endsection