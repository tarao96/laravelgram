@extends('layouts.app')
@section('title', 'マイページ')

@section('content')
<h1 class="text-center">こんにちは、{{ $user->name }}さん！</h1>
<div class="posts-wrapper">
    <h2 class="past-posts-title">過去の投稿一覧</h2>
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
            <div class="post-btns">
                <button type="button" class="del-btn">削除</button>
                <button type="button" class="edit-btn">編集</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
@endsection
