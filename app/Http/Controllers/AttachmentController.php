<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attachment = Attachment::create([
        'task_id' => $request->task_id,
        'link' => $request->link
        ]);

        return response()->json($attachment)->setStatusCode(200, 'Successful task creation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $attachment = Attachment::find($request->id);
        return response()->json($attachment)->setStatusCode(200, 'Successful extraction');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        $attachment = Attachment::find($request->id);
        $attachment->update([
            'task_id' => $request->task_id,
            'link' => $request->link
        ]);

        return response()->json($attachment)->setStatusCode(200, 'Successful task creation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $attachment = Attachment::find($request->id);
        if($attachment->delete()) {
            return response('Successfully deleted', 200);
        }
    }
}
