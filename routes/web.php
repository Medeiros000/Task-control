<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MessageTestMail;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('task', 'App\Http\Controllers\TaskController');

Route::get('/message-test', function () {
    return new MessageTestMail();
    // Mail::to('user@localhost')->send(new MessageTestMail());
    // return 'A message has been sent to the email address provided.';
});
