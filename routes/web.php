<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/todos', [ToDoController::class, 'index'])->name('todos.index');
Route::post('/todos', [ToDoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{id}/toggle', [ToDoController::class, 'toggle'])->name('todos.toggle');
Route::delete('/todos/{id}', [ToDoController::class, 'destroy'])->name('todos.destroy');
