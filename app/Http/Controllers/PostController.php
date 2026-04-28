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

    public function show() {}

    public function store(Request $request)
    {

        Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(['message' => 'Post created successfully!']);
    }


    public function update() {}
    public function destroy() {}
}
