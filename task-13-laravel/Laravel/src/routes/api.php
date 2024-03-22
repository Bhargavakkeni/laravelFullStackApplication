<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Books\BooksController;
use App\Models\User;
use App\Models\Host;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.basic')->group(function () {
    Route::apiResource('books', BooksController::class);
});

Route::get('/', function () {
    return response()->json([
        'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
    ]);
});

//Route::resource('host/users', 'App\Http\Controllers\UserController');
Route::resource('host/users', 'App\Http\Controllers\HostController');
Route::resource('host/projects', 'App\Http\Controllers\ProjectController');

Route::get('/get/users', function () {
    $user = User::all();
    foreach ($user as $user) {
        echo $user->id;
        echo "<br>";
        echo $user->name;
    }
});

Route::get('/host/user/{user_id}/projects', function ($user_id) {
    $user = Host::find($user_id);
    $project_array = [];
    if ($user === null) {
        return response()->json(['error'=>'Not Found'], 404);
    } else {
        foreach ($user->projects as $project) {
            //echo $project;
            array_push($project_array, $project);
        }
        return response()->json($project_array);
    }
});
