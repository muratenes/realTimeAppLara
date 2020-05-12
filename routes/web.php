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
Route::get('/t/{text}', function () {
    event(new \App\Events\SendMessage(request()->route()->parameter('text')));
    dd('Event Run Successfully.');
});


Route::get('/u/{id}', function () {
    $user = \App\User::findOrFail(request()->route()->parameter('id'));
    $user->notify(new \App\Notifications\NewComment($user));
    event(new \App\Notifications\NewComment($user));
    dump($user);
    dd('User event göndeirldi');
});
