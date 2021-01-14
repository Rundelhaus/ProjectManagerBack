<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks)->setStatusCode(200, 'Successful task output');
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
        'project_id' => 'required|integer|exists:projects,id',
        'completed' => 'boolean',
        'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 400);
        }

        $task = Task::create([
        'name' => $request->name,
        'project_id' => $request->project_id,
        'completed' => $request->completed,
        'deadline' => $request->deadline,
        'description' => $request->description
        ]);

        return response()->json($task)->setStatusCode(200, 'Successful task creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        return Task::find($id);
    }

    public static function show_out($id)
    {
        $tasks = Task::where('project_id', $id)->get();
        $tasks_id = $tasks->pluck('id');

        $data = [];
        foreach ($tasks_id as $tsk_id){
            array_push($data, [ 'task' => TaskController::show($tsk_id), 'subtasks' => SubtaskController::show_out($tsk_id) ]);
        }

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'project_id' => 'required|integer|exists:projects,id',
            'completed' => 'boolean',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 400);
        }

        $task = Task::find($request->id);
        $task->update([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'completed' => $request->completed,
            'deadline' => $request->deadline,
            'description' => $request->description
        ]);

        return response()->json($task)->setStatusCode(200, 'Successful task update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $task = Task::find($request->id);
        if($task->delete()) {
            return response('Successfully deleted', 200);
        }
    }
}
