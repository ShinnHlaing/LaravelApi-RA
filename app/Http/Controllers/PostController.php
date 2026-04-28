<?php

namespace App\Http\Controllers;

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
        dd($request->all());
    }


    public function update() {}
    public function destroy() {}
}
