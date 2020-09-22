<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts', function () {
    $users = (object) [
        (object) [
            "name" => "user 1",
            "age" => "1"
        ],
        (object) [
            "name" => "user 1",
            "age" => "1"
        ],
        (object) [
            "name" => "user 1",
            "age" => "1"
        ],
        (object) [
            "name" => "user 1",
            "age" => "1"
        ],
    ];
    return view('posts.index', ["users" => $users]);
});
