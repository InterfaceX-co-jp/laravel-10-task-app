<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'tasks' => $tasks
        ]);
    }

    public function create(Request $request)
    {
        $task = Task::create([
            'content' => $request->input('content')
        ]);

        return response()->json([
            'task' => $task
        ]);
    }

    public function update(Request $request, int $id)
    {
        $task = Task::find($id);

        if ($task === null) {
            return response('Task not found', 404);
        }

        $task->update([
            'content' => $request->input('content')
        ]);

        return response()->json([
            'task' => $task
        ]);
    }

    public function show(int $id)
    {
        $task = Task::find($id);

        return response()->json([
            'task' => $task
        ]);
    }

    public function destroy(int $id)
    {
        Task::destroy($id);

        return response()->json();
    }
}
