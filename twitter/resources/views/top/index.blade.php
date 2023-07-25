@extends('layouts.master')
@section('title','top')

@auth
<div>
@section('mypage')
<a href="{{ route('users.findByUserId', [ 'id' => Auth::id()]) }}">マイページ</a>
@endsection
</div>
@endauth

