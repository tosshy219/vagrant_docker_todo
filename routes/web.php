<?php

use Illuminate\Support\Facades\Route;
//todoコントローラー追加
use App\Http\Controllers\TodoController;

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

Route::get('/',[TodoController::class,'index'] );

Route::get('/create',[TodoController::class,'create'])->name('create');
Route::post('/store',[TodoController::class,'store'])->name('store');
