<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Host;

class GetUsersController extends Controller
{
    public function index(){
        $users = Host::all();
        //return view('index', compact('users'));
    }
}
