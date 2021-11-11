<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
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



    Route::name('home')->get('/', [HomeController::class, 'index']);
    Route::name('create_post_path')->get('/post/create', [PostController::class, 'create']);
    Route::name('markAsRead_post_path')->get('/post/markAsRead', [PostController::class,'markAsRead']);
    //Route::name('markAsRead_post_path')->get('/post/markAsRead',[PostController::class, 'markAsRead']);
    Route::name('markNotification')->post('/post/markNotification',[PostController::class, 'markNotification']);

});

// Route::get('/', function () {
//     return view('');

// });


Route::name('index_post_path')->get('/post', [PostController::class, 'index']);

Route::name('store_post_path')->post('/post', [PostController::class, 'store']);
// Route::name('create_post_path')->get('/post', [PostController::class, 'create']);
