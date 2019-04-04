<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $task = $request->user()->tasks();

        if($request->has('complete')){
            $task->complete();
        }else{
            $task->incomplete();
        }

        return view('task.index', [
            'tasks' => $task->orderBy('date')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date'
        ]);

        /** @var User $user */
        $user = $request->user();

        $user->tasks()->create($request->all());

        return back()->withStatus('Task created.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    public function status(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|numeric|in:0,1'
        ]);

        $task->update([
            'is_complete' => $request->status
        ]);

        return back()->withStatus('Task updated.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date'
        ]);

        $task->update($request->all());

        return back()->withStatus('Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return back()->withStatus('Task has been deleted.');
    }
}
