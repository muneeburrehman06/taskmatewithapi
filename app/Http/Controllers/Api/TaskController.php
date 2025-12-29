<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // List all tasks
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->get();
        return response()->json(['tasks' => $tasks]);
    }

    // Create a task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = $request->user()->tasks()->create($request->only('title','description'));
        return response()->json(['success'=>true,'task'=>$task,'message'=>'Task Added Successfully']);
    }

    // Show single task
    public function show(Task $task, Request $request)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['success'=>false,'message'=>'Not allowed'],403);
        }

        return response()->json(['success'=>true,'task'=>$task]);
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['success'=>false,'message'=>'Not allowed'],403);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'sometimes|boolean',
        ]);

        $task->update($request->only('title','description','is_completed'));

        return response()->json(['success'=>true,'task'=>$task,'message'=>'Task Updated Successfully']);
    }

    // Delete a task
    public function destroy(Task $task, Request $request)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['success'=>false,'message'=>'Not allowed'],403);
        }

        $task->delete();

        return response()->json(['success'=>true,'message'=>'Task deleted Successfully']);
    }
}
