<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        try {
            $todo = Todo::all();
            return response()->json([
                'message' => 'Todos retrieved successfully!',
                'data' => TodoResource::collection($todo)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Server Error!'
            ], 500);
        }
    }

    public function show(int $id)
    {
        try {
            $todo = Todo::find($id);
            return response()->json([
                'message' => 'Todos retrieved successfully!',
                'data' => TodoResource::make($todo)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Server Error!'
            ], 500);
        }
    }

    public function store(StoreTodoRequest $request)
    {
        try {
            $todo = Todo::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'date' => $request->date,
            ]);
            $todo->save();
            return response()->json([
                'message' => 'Todos created successfully!',
                'data' => TodoResource::make($todo)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Server Error!'
            ], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $todo = Todo::find($id);
            $todo->title = $request->title;
            $todo->description = $request->description;
            $todo->status = $request->status;
            $todo->date = $request->date;
            $todo->save();
            return response()->json([
                'message' => 'Todos updated successfully!',
                'data' => TodoResource::make($todo)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Server Error!'
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $todo = Todo::find($id);
            $todo->delete();
            return response()->json([
                'message' => 'Todos deleted successfully!',
                'data' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Server Error!'
            ], 500);
        }
    }
}
