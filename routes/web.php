<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks/trashed', [TaskController::class, 'trashed_tasks']);

Route::get('/', [TaskController::class, 'index']);

Route::resource('tasks', TaskController::class);


