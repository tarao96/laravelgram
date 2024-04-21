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
                <img src="{{ $post->image_path ? $post->image_path : 'img/sample-img.jpeg' }}" alt="サンプル画像">
            </div>
            <div class="card-body">
                <div class="card-title">
                    <h3>{{ $post->title }}</h3>
                </div>
                {{ $post->body}}
            </div>
            <div class="post-btns">
                <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @method('DELETE')
                    @csrf
                    <button class="del-btn">削除</button>
                </form>
                <button type="button" class="edit-btn" data-post-id="{{ $post->id }}">編集</button>
            </div>
        </div>
        <div class="modal-wrapper" id="post-{{ $post->id }}">
            <div class="modal">
                <div class="modal-title">
                    <h2>投稿更新</h2>
                    <span class="close" data-post-id="{{ $post->id }}">×</span>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="post-image">投稿画像</label>
                            <input type="file" name="image" id="post-image">
                        </div>
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" name="title" id="title" placeholder="タイトル" value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label for="body">本文</label>
                            <textarea name="body" id="body" cols="50" rows="10" placeholder="本文">{{ $post->body }}</textarea>
                        </div>
                        <button type="submit" data-post-id="{{ $post->id }}">更新</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script>
    const deleteBtns = document.querySelectorAll('.del-btn');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (confirm('本当に削除しますか？')) {
                btn.closest('form').submit();
            }
        });
    });

    const editBtns = document.querySelectorAll('.edit-btn');
    const modal = document.querySelector('.modal');
    const closes = document.querySelectorAll('.close');
    const form = document.querySelector('form');
    const modalWrappers = document.querySelectorAll('.modal-wrapper');

    editBtns.forEach(editBtn => {
        editBtn.addEventListener('click', (e) => {
            const postId = e.target.dataset.postId;
            const modalWrapper = document.getElementById(`post-${postId}`);
            modalWrapper.classList.add('is-show');
        });

        form.addEventListener('submit', (e) => {
            const postId = e.target.dataset.postId;
            const modalWrapper = document.getElementById(`post-${postId}`);
            modalWrapper.classList.remove('is-show');
        });
    });

    closes.forEach(close => {
        close.addEventListener('click', (e) => {
            const postId = e.target.dataset.postId;
            const modalWrapper = document.getElementById(`post-${postId}`);
            modalWrapper.classList.remove('is-show');
        });
    });

    modalWrappers.forEach(modalWrapper => {
        modalWrapper.addEventListener('click', (e) => {
            if (!modalWrapper.querySelector('.modal').contains(e.target)) {
                modalWrapper.classList.remove('is-show');
            }
        });
    });
</script>
@endsection
