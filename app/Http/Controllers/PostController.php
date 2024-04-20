<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('app.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;
        // $post->image_path = $request->image_path;
        $post->save();

        return redirect()->route('post.index');
    }

    public function delete(int $id)
    {
        Post::find($id)->delete();
        return redirect()->route('user.mypage');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => ['required', 'max: 255'],
            'body' => ['required'],
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route('user.mypage');
    }
}
