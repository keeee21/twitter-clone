@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <form method="post" action="{{ route('edit') }}">
                            @csrf
                            @method('PUT')
                            <p class="card-text">名前：<input type="text" name="name" value="{{ $user->name }}"></p>
                            <p class="card-text">メール：<input type="email" name="email" value="{{ $user->email }}" ></p>
                            <input type="submit" value="保存">
                        </form>
                        <form method="get" action="{{ route('show',['id' => Auth::id()]) }}">
                            @csrf
                            <input type="submit" value="キャンセル">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection