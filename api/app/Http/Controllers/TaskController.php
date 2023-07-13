<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Si el usuario es administrador, obtener todas las tareas
        if ($user->role_id === 1) {
            $tasks = Task::all();
        } else {
            // Si el usuario es usuario normal, obtener solo las tareas del usuario
            $tasks = $user->tasks;
        }

        return response()->json(['tasks' => $tasks], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $user = Auth::user();
        $task = $user->tasks()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => false,
        ]);

        return response()->json(['task' => $task], 201);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'completed' => 'boolean',
        ]);

        if ($task->user_id !== Auth::user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => $request->input('completed', false),
        ]);

        return response()->json(['task' => $task], 200);
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
