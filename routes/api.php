<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

//ROUTES POUR LES TÂCHES 

Route::apiResource('tasks', TaskController::class);
