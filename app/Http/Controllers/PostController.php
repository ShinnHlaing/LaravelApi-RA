<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Welcome from API project!']);
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
