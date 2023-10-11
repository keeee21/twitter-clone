@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <form method="post" action="{{ route('tweet.update',$tweet->id)}} ">
                            @csrf
                            @method('put')
                            @error('tweet')
                                <h5>{{ $message }}</h5>
                            @enderror
                            <div class="card-text">
                                <textarea name="tweet" cols="70" rows="5" value="{{ old('tweet') ?? $tweet->tweet }}"></textarea>
                            </div>
                            <input type="submit" value="保存">
                        </form>
                        <form method="get" action="{{ route('tweet.detail',$tweet->id) }}">
                            <input type="submit" value="戻る">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection