<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the tasks in the database
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check & Collect the request data
        $data = $request->validate([
            'title' => 'required|string',
            'done' => 'required|boolean'
        ]);

        //Add the new task in the database
        $task = Task::create($data);

        return response($task, 201);
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
        // Check & Collect the request data
        $data = $request->validate([
            'title' => 'required|string',
            'done' => 'required|boolean'
        ]);

        //Add the new task in the database
        $task->update($data);

        return response($task, 200);
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
        return response('Task item deleted', 200);
    }
}
