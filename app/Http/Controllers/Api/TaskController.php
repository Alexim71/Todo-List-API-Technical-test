<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * GET /api/tasks 
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'success' => true,
            'data' => $tasks
        ], 200);
    }

    /**
     * POST /api/tasks 
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:50'
        ]);

        $task = Task::create($validated);

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Tâche créée avec succès'
        ], 201);
    }

    /**
     * GET /api/tasks/{id} 
     */
    public function show(Task $task)
    {
        return response()->json([
            'success' => true,
            'data' => $task
        ], 200);
    }

    /**
     * PUT /api/tasks/{id} 
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:50'
        ]);

        $task->update($validated);

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Tâche mise à jour avec succès'
        ], 200);
    }

    /**
     * DELETE /api/tasks/{id} 
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tâche supprimée avec succès'
        ], 200);
    }

}
