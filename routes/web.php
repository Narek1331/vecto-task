<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::group(['prefix' => 'post'], function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');;
    Route::get('/create', [PostController::class, 'create']);
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/{id}', [PostController::class, 'show']);
    Route::post('/', [PostController::class, 'store']);
    Route::put('/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});
