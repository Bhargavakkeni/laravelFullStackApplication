<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('host/users', 'App\Http\Controllers\HostController');
Route::resource('host/projects', 'App\Http\Controllers\ProjectController');
