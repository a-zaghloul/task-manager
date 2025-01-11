<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoretaskRequest;
use App\Http\Requests\UpdatetaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('completed',0)->get();
        $completedTasks = Task::where('completed',1)->get();
        return view('tasks.index', compact('tasks', 'completedTasks'));
    }

    public function trashed_tasks()
    {
        $trashedTasks = Task::onlyTrashed()->get();
        return view('tasks.trashed', compact('trashedTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretaskRequest $request) {
        Task::create($request->input());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetaskRequest $request, Task $task) {

        $completed = !$task->completed;

        // $request->has('completed') == 1 ? $completedAt = now()->format('Y-m-d') : $completedAt = $task->completed_at;
        $completed ? $completedAt = now()->format('Y-m-d') : $completedAt = $task->completed_at;
        $task->update([
            'completed' => $completed,
            'completed_at' => $completedAt,
        ]);
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {
        $task->delete();
        return redirect('/');
    }
}
