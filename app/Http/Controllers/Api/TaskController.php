<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Throwable;

class TaskController extends Controller
{
    /**
     * Допустимые статусы для задачи
     */
    private const ALLOWED_STATUSES = [
        'делать',
        'на_удерживании', 
        'в_ходе_выполнения',
        'законченный'
    ];

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
                'count' => $tasks->count(),
                'message' => 'Задачи успешно получены'
            ], 200);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Ошибка при получении списка задач',
                $e
            );
        }
    }

    /**
     * POST /api/tasks
     * Создает новую задачу или возвращает существующую задачу.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => [
                    'nullable',
                    'string',
                    'max:50',
                    Rule::in(self::ALLOWED_STATUSES)
                ]
            ]);

          
            $existingTask = Task::where('title', $validated['title'])->first();

            if ($existingTask) {
                
                return response()->json([
                    'success' => true,
                    'data' => $existingTask,
                    'message' => 'Задача с таким названием уже существует. Вы можете изменить её статус или удалить её.',
                    'existing' => true
                ], 200); 
            }

           
            $validated['status'] = $validated['status'] ?? 'делать';

            $task = Task::create($validated);

            return response()->json([
                'success' => true,
                'data' => $task,
                'message' => 'Задача успешно создана'
            ], 201);
            
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $e->errors()
            ], 422);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Ошибка при создании задачи',
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
                'message' => 'Задача успешно найдена'
            ], 200);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена',
                'error' => "Задача с ID {$id} не существует"
            ], 404);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Ошибка при получении задачи',
                $e
            );
        }
    }



    /**
 * PUT /api/tasks/{id}
 * Обновляет существующую задачу
 */
public function update(Request $request, $id): JsonResponse
{
    try {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                
                Rule::unique('tasks')->ignore($task->id)
            ],
            'description' => 'nullable|string',
            'status' => [
                'nullable',
                'string',
                'max:50',
                Rule::in(self::ALLOWED_STATUSES)
            ]
        ]);

        
        $changesDetected = false;
        $unchangedFields = [];

        foreach ($validated as $field => $value) {
            if ($task->$field != $value) {
                $changesDetected = true;
                break;
            } else {
                $unchangedFields[] = $field;
            }
        }

       
        if (!$changesDetected && !empty($validated)) {
            return response()->json([
                'success' => true,
                'data' => $task,
                'message' => 'Изменений не обнаружено. Данные уже актуальны.',
                'unchanged_fields' => $unchangedFields
            ], 200); 
        }

       
        $oldData = [
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status
        ];

        $task->update($validated);

        
        $changes = [];
        foreach ($validated as $field => $value) {
            if ($oldData[$field] != $value) {
                $changes[$field] = [
                    'old' => $oldData[$field],
                    'new' => $value
                ];
            }
        }

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Задача успешно обновлена',
            'changes' => $changes
        ], 200);
        
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Задача не найдена',
            'error' => "Задача с ID {$id} не существует"
        ], 404);
        
    } catch (ValidationException $e) {
        
        $errors = $e->errors();
        if (isset($errors['title']) && str_contains($errors['title'][0] ?? '', 'уже существует')) {
            $existingTask = Task::where('title', $request->title)->first();
            
           
            if ($existingTask && $existingTask->id != $id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Задача с таким названием уже существует',
                    'errors' => $errors,
                    'existing_task' => [
                        'id' => $existingTask->id,
                        'title' => $existingTask->title,
                        'status' => $existingTask->status
                    ]
                ], 409); 
            }
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Ошибка валидации',
            'errors' => $errors
        ], 422);
        
    } catch (Throwable $e) {
        return $this->handleError(
            'Ошибка при обновлении задачи',
            $e
        );
    }
}



    /**
     * DELETE /api/tasks/{id}
     * Удалить существующую задачу
     */
    public function destroy($id): JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            
          
            $taskTitle = $task->title;
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => "Задача '{$taskTitle}' успешно удалена"
            ], 200);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Задача не найдена',
                'error' => "Задача с ID {$id} не существует"
            ], 404);
            
        } catch (Throwable $e) {
            return $this->handleError(
                'Ошибка при удалении задачи',
                $e
            );
        }
    }



    /**
     * Централизованное управление ошибками
     */
    private function handleError(string $message, Throwable $e): JsonResponse
    {
        
        \Log::error($message, [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => config('app.debug') ? $e->getTraceAsString() : null
        ]);

       
        $errorDetails = config('app.debug') ? $e->getMessage() : 'Произошла внутренняя ошибка сервера.';

        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $errorDetails
        ], 500);
    }
}