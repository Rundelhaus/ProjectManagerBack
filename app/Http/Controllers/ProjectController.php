<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects)->setStatusCode(200, 'Successful projects output');
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
            'name' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'completed' => 'nullable',
            'deadline' => 'nullable',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $project = Project::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'completed' => $request->completed,
            'deadline' => $request->deadline,
            'description' => $request->description,
        ]);

        return response()->json($project)->setStatusCode(200, 'Successful project creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProjectController::find($id);
    }


    public function showAll(Request $request)
    {
        $projects = User::where('user_id', $request->id)->get();
        $projects_id = $projects->pluck('id');

        $data = [];
        foreach ($projects_id as $proj_id){
            array_push($data, [ 'project' => [ProjectController::show($proj_id)], 'tasks' => [TaskController::show_out($proj_id)] ]);
        }

        return response()->json($data)->setStatusCode(200, 'Successful extraction');
    }

    public function showOne($user_id)
    {
        $project = Project::find($user_id)->get();

        $data = TaskController::show_out($project->id);

        return response()->json($data)->setStatusCode(200, 'Successful extraction');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
