<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Throwable;

class TaskController extends Controller
{
    /**
     * GET /api/tasks
     */
    public function index(): JsonResponse
    {
        try {
            $tasks = Task::all();
            
            return response()->json([
                'success' => true,
                'data' => $tasks,
                'message' => 'Tâches récupérées avec succès'
            ], 200);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Erreur lors de la récupération des tâches',
                $e
            );
        }
    }

    /**
     * POST /api/tasks
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'nullable|string|max:50|in:en_attente,en_cours,terminee'
            ]);

            $task = Task::create($validated);

            return response()->json([
                'success' => true,
                'data' => $task,
                'message' => 'Tâche créée avec succès'
            ], 201);
            
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Erreur lors de la création de la tâche',
                $e
            );
        }
    }

    /**
     * GET /api/tasks/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $task,
                'message' => 'Tâche récupérée avec succès'
            ], 200);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tâche non trouvée',
                'error' => "Aucune tâche trouvée avec l'ID {$id}"
            ], 404);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Erreur lors de la récupération de la tâche',
                $e
            );
        }
    }

    /**
     * PUT /api/tasks/{id}
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $task = Task::findOrFail($id);

            $validated = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'nullable|string|max:50|in:en_attente,en_cours,terminee'
            ]);

            $task->update($validated);

            return response()->json([
                'success' => true,
                'data' => $task,
                'message' => 'Tâche mise à jour avec succès'
            ], 200);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tâche non trouvée',
                'error' => "Aucune tâche trouvée avec l'ID {$id}"
            ], 404);
            
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Erreur lors de la mise à jour de la tâche',
                $e
            );
        }
    }

    /**
     * DELETE /api/tasks/{id}
     */
    public function destroy($id): JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tâche supprimée avec succès'
            ], 200);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tâche non trouvée',
                'error' => "Aucune tâche trouvée avec l'ID {$id}"
            ], 404);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Erreur lors de la suppression de la tâche',
                $e
            );
        }
    }

    /**
     * Gestion centralisée des erreurs
     */
    private function handleError(string $message, Throwable $e): JsonResponse
    {
        // Log l'erreur pour le débogage
        \Log::error($message, [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        // En environnement de production, on masque les détails techniques
        $errorDetails = config('app.debug') ? $e->getMessage() : 'Une erreur interne est survenue';

        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $errorDetails
        ], 500);
    }
}