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
<div class="plus">+</div>
<div class="modal-wrapper">
    <div class="modal">
        <div class="modal-title">
            <h2>新規投稿</h2>
            <span class="close">×</span>
        </div>
        <div class="modal-body">
            <form action="{{ route('post.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="post-image">投稿画像</label>
                    <input type="file" name="post-image" id="post-image">
                </div>
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title" placeholder="タイトル">
                </div>
                <div class="form-group">
                    <label for="body">本文</label>
                    <textarea name="body" id="body" cols="50" rows="10" placeholder="本文"></textarea>
                </div>
                <button type="submit">投稿</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const plus = document.querySelector('.plus');
    const modalWrapper = document.querySelector('.modal-wrapper');
    const modal = document.querySelector('.modal');
    const close = document.querySelector('.close');
    const form = document.querySelector('form');

    plus.addEventListener('click', () => {
        modalWrapper.classList.add('is-show');
    });

    close.addEventListener('click', (e) => {
        modalWrapper.classList.remove('is-show');
    });

    form.addEventListener('submit', () => {
        modalWrapper.classList.remove('is-show');
    });

    modalWrapper.addEventListener('click', (e) => {
        if (!modal.contains(e.target)) {
            modalWrapper.classList.remove('is-show');
        }
    });
</script>
@endsection
