<?php

namespace App\Http\Controllers;

use App\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Lists as ListsResource;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the tasks in the database
        return Lists::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check & Collect sent data
        $data = $request->validate([
            'title' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        //Add the new task in the database
        $list = Lists::create($data);
        
        return response($list, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lists  $list
     * @return \Illuminate\Http\Response
     */
    public function show(Lists $list)
    {
        return new ListsResource(Lists::find(2));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lists  $user_list
     * @return \Illuminate\Http\Response
     */
    public function user($user_list)
    {
        $lists = DB::table('lists')->where('user_id', '=', $user_list)->get();

        return response($lists, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lists  $list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lists $list)
    {
         // Check & Collect sent data
         $data = $request->validate([
            'title' => 'required|string'
        ]);

        //Add the new task in the database
        $list->update($data);

        return response($list, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lists  $list
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lists $list)
    {

        //Delete a list from database
        $list->delete();
        return response('List item deleted', 200);
    }
}