@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">プロフィール</h5>
                        <p class="card-text">名前：{{ $user_detail->name }}</p>
                        <p class="card-text">メール：{{ $user_detail->email }}</p>
                        <form method="get" action="{{ route('userEditDisplay') }}">
                            @csrf
                            <input type="submit" value="編集">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
