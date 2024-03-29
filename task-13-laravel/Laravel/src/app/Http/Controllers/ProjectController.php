<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Host;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        
        return response($project, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['error' => 'Method Not Allowed'], 405);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project;
        $project->user_id = $request->get('user_id');
        $project->title = $request->get('title');
        $project->description = $request->get('description');
        $project->save();
        return response()->json(['Created successfuly'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Host::find($id);
        $project_array = [];
        if ($user === null) {
            return response()->json(['error' => 'Not Found'], 404);
        } else {
            foreach ($user->projects as $project) {
                array_push($project_array, $project);
            }
            //return response()->json($project_array);
        }
        return view('projects.index', compact('project_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['error' => 'Method Not Allowed'], 405);

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
        return response()->json(['error' => 'Method Not Allowed'], 405);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project)
    {
        list($id, $user_id) = explode('-', $project);
        $project = Project::find($id);
        if ($project === null) {
            return response(['error' => 'Not Found'], 404);
        }
        $project->delete();
        return to_route('projects.show', $user_id);
    }
}
