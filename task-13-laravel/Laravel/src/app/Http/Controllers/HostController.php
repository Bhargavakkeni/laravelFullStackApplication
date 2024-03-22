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
        $host = Host::all();
        
        return response($host, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$host = new Host;
        $host->name = 'shankar';
        $host->email = 'shankar123@gmail.com';
        $host->gender = 'male';
        $host->save();
        echo "Created successfuly";*/
        return response()->json(['error'=>'Method Not Allowed'], 405);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $host = new Host;
        $host->name = $request->get('name');
        $host->email = $request->get('email');
        $host->gender = $request->get('gender');
        $host->save();
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
        return response()->json(['error'=>'Method Not Allowed'], 405);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['error'=>'Method Not Allowed'], 405);

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
        return response()->json(['error'=>'Method Not Allowed'], 405);

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
        if($host === null){
            return response()->json(['error'=>'Not Found'], 404);
        }
        $host->delete();
        return response()->json(['Deleted successfuly'], 200);
    }
}
