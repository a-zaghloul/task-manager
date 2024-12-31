<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('tasks', TaskController::class);
