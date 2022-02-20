<?php

namespace App\Http\Controllers;

use App\Models\TaskGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task_groups = TaskGroup::all();
        return compact('task_groups');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('screens.task_group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task_group = TaskGroup::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'finished' => $request->finished,
            'canceled' => $request->canceled,
            'user_id' => $request->user_id,
            'slug' => $request->slug,
        ]);

        if ($task_group !== null) {
            return redirect('task-groups');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task_group = TaskGroup::find($id);
        return view('screens.task_group.create', compact('task_group'));
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
        $task_group = TaskGroup::find($id);
        $task_group->title = $request->title;
        $task_group->description = $request->description;

        $task_group ->save();
        return redirect('task-grous');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task_group = TaskGroup::find($id);

        if (Gate::allows('delete-task-group', $task_group)) {
            $task_group->delete();
            return back();
        }
        return abort(403);
    }
}
