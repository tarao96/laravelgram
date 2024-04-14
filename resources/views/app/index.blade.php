@extends('layouts.app')
@section('title', '投稿一覧画面')
@section('content')
<a href="{{ route('user.mypage') }}" class="mypage-link">マイページ</a>
<div class="posts">
    @foreach ($posts as $post)
    <div class="card">
        <div class="card-img">
            <img src="img/sample-img.jpeg" alt="サンプル画像">
        </div>
        <div class="card-body">
            <div class="card-title">
                <h3>{{ $post->title }}</h3>
            </div>
            {{ $post->body}}
        </div>
    </div>
    @endforeach
</div>
@endsection
