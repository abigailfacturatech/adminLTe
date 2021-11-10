<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::middleware(['auth'])->group(function(){



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::name('create_post_path')->get('/post', [PostController::class, 'create']);

});

Route::name('create_post_path')->get('/post', [PostController::class, 'create']);
Route::name('store_post_path')->post('/post', [PostController::class, 'store']);
