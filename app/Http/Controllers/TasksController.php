<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        // Task::create($request->only('name', 'description'));

        $payload = $request->validate([
            'name' => 'required|min:6|max:255',
            'description' => 'required|min:12|max:255',
        ]);

        Task::create($payload);

        return back();
    }
}
