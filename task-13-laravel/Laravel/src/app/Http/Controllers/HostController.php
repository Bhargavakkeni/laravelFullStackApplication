<?php

namespace App\Http\Controllers;

use App\Models\Host;


use Illuminate\Http\Request;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Host::paginate(5);

        return view('user.index', compact('users'))
            ->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
        /*$host = new Host;
        $host->name = 'shankar';
        $host->email = 'shankar123@gmail.com';
        $host->gender = 'male';
        $host->save();
        echo "Created successfuly";
        return response()->json(['error' => 'Method Not Allowed'], 405);*/


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
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required'
        ]);

        $user = new Host;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->gender = $request->get('gender');
        $user->save();
        return to_route('users.index');
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
        return response($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Host::find($id);

        return view('user.edit', compact('user'));

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
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required'
        ]);
        $user = Host::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->gender = $request->get('gender');
        $user->save();
        return to_route('users.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $host = Host::find($id);
        if ($host === null) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        $host->delete();
        return to_route('users.index');
    }
}
