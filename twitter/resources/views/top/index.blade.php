@extends('layouts.master')
@section('title','top')

@auth
<div>
@section('content')
    <a href="{{ route('users.findByUserId', [ 'id' => Auth::id()]) }}">マイページ</a>
@endsection
</div>
@endauth

