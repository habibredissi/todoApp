<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the tasks in the database
        return Tasks::all();
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
            'done' => 'required|boolean',
            'list_id' => 'required|integer'
        ]);

        //Add the new task in the database
        $task = Tasks::create($data);

        return response($task, 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasks  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $task)
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
     * @param  \App\Tasks  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        return response('Task item deleted', 200);
    }
}