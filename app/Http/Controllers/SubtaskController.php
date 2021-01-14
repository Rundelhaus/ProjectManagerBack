<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtasks = Subtask::all();
        return response()->json($subtasks)->setStatusCode(200, 'Successful task output');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'task_id' => 'required|integer|exists:tasks,id',
            'completed' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 400);
        }

        $task = Subtask::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'completed' => $request->completed,
            'description' => $request->description
        ]);

        return response()->json($task)->setStatusCode(200, 'Successful task creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function show(Subtask $subtask)
    {
        //
    }

    public static function show_out($id)
    {
        $subtasks = Subtask::where('$task_id', $id)->get();
        return $subtasks;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtask $subtask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtask $subtask)
    {
        //
    }
}
