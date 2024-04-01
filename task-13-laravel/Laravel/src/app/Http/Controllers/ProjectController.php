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
        $projects = Project::paginate(5);

        return view('project.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->get('user_id');

        if ($user_id === null) {
            $user_id = 'null';
        }

        return view('project.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        $project = new Project;
        $project->user_id = $request->get('user_id');
        $project->title = $request->get('title');
        $project->description = $request->get('description');
        $project->save();

        return to_route('projects.show', $project->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 'null') {
            return to_route('projects.index');
        }
        $user = Host::find($id);
        $user_id = $id;
        $project_array = [];
        if ($user === null) {
            return response()->json(['error' => 'Not Found'], 404);
        } else {
            foreach ($user->projects as $project) {
                array_push($project_array, $project);
            }
            //return response()->json($project_array);
        }
        return view('project.show', compact('project_array', 'user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('project.edit', compact('project'));

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
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        $project = Project::find($id);
        $project->user_id = $request->get('user_id');
        $project->title = $request->get('title');
        $project->description = $request->get('description');
        $project->save();

        return to_route('projects.show', $project->user_id);

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
