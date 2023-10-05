@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">登録ユーザー</h5>
                        @foreach ($users as $users)
                            <div class="card-text">
                                <p>・{{ $users['name'] }}</p>
                                {{ $users->links() }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
