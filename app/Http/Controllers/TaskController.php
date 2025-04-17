<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$tasks = auth()->user()->tasks()->paginate(1);
		return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return view('tasks.create');
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
		auth()->user()->tasks()->create($request->validated());
		return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
		return view('tasks.edit', compact('task'));
	}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
		$task->update($request->all());
		return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
		$task->delete();
		return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

	public function toggleStatus(Task $task)
	{
		$task->is_completed = !$task->is_completed;
		$task->save();

		return redirect()->route('tasks.index')->with('success', 'Task status updated.');
	}
}
