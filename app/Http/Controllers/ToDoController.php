<?php

namespace App\Http\Controllers;

use App\Services\FileStorageService;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
private $fileStoragePath;

    public function __construct(FileStorageService $fileStorageService)
    {
        $this->fileStoragePath = $fileStorageService;
    }

    public function index()
    {
        $todos = $this->fileStoragePath->getAll();
        return view('todos', compact('todos'));
    }

    public function store()
    {
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $this->fileStoragePath->create($validated);

        return redirect()->route('todos.index')->with('success', 'Task created successfully.');
    }

    public function toggle($id)
    {
        $todo = $this->fileStoragePath->toggle($id);
        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'Task not found');
        }
        return redirect()->route('todos.index')->with('success', 'Task competed');
    }
    public function destroy($id){
        $deleted = $this->fileStoragePath->destroy($id);

        if(!$deleted){
            return redirect()->route('todos.index')->with('error', 'Task not found');
        }
        return redirect()->route('todos.index')->with('success', 'Task deleted');
    }
}
