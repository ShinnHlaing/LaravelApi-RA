<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return response()->json(['message' => 'Posts retrieved successfully!', 'data' => $post]);
    }

    public function show(int $id)
    {
        $post = Post::find($id);
        return response()->json(['message' => 'Post retrieved successfully!', 'data' => $post]);
    }

    public function store(Request $request)
    {

        Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Post created successfully!']);
    }

    public function update(Request $request, int $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return response()->json(['message' => 'Post updated successfully!']);
    }

    public function destroy() {}
}
