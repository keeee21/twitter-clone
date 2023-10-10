@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">ツイート一覧</h5>
                        @foreach ($tweets as $tweet)
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    {{ $tweet->user->name }}
                                    {{ $tweet->tweet }}
                                </li>
                            </ul>
                        @endforeach
                        {{ $tweets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection