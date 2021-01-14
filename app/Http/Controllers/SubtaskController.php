<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
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
            'task_id' => $request->task_id,
            'completed' => $request->completed,
        ]);

        return response()->json($task)->setStatusCode(200, 'Successful subtask creation');
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
        $subtasks = Subtask::where('task_id', $id)->get();
        return $subtasks;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'task_id' => 'required|integer|exists:tasks,id',
            'completed' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 400);
        }

        $task = Task::find($request->id);
        $task->update([
            'name' => $request->name,
            'task_id' => $request->task_id,
            'completed' => $request->completed,
        ]);

        return response()->json($task)->setStatusCode(200, 'Successful subtask update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subtask = Subtask::find($request->id);
        if($subtask->delete()) {
            return response('Successfully deleted', 200);
        }
    }
}
