<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $post = Post::all();
            return response()->json(['message' => 'Posts retrieved successfully!', 'data' => PostResource::collection($post)]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Sever error!']);
        }
    }

    public function show(int $id)
    {
        try {
            $post = Post::find($id);
            return response()->json(['message' => 'Post retrieved successfully!', 'data' => PostResource::make($post)], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Sever error!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content
            ]);

            return response()->json(['message' => 'Post created successfully!', 'data' => PostResource::make($post)], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Sever error!'], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();
            return response()->json(['message' => 'Post updated successfully!', 'data' => PostResource::make($post)], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Sever error!'], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $post = Post::find($id);
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully!', 'data' => null], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Sever error!'], 500);
        }
    }
}
