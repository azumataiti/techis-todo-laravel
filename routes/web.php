<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//tasksのURLとTaskcontrollerのindexメソッドを結びつける＝ルーティング
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
Route::post('/task', [App\Http\Controllers\TaskController::class, 'store'])->name('task');
Route::delete('/task/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('/task/{task}');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
