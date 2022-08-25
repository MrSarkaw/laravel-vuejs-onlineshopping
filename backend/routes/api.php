<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware(['auth:api'])->group(function () {
     Route::post('/logout', [LogoutController::class, 'logout']);
     Route::get('/getuser', [LogoutController::class, 'getUser']);

     //users
     Route::post('/addto-favcart/{id}/{cart}', [PublicController::class, 'addToFavCart']);
     Route::resource('profile', ProfileController::class)->except(['create', 'show', 'delete', 'create', 'edit']);

     Route::post('buy/{id}', [PublicController::class, 'buy'])->name('buy');
     Route::delete('delete/{id}', [PublicController::class, 'delete'])->name('delete');
     Route::get('/post/{id}', [PublicController::class, 'showPost'])->name('showpost');

     Route::middleware(['isAdmin'])->group(function(){
        Route::resource('admin/user', UserController::class)->except(['show', 'create']);
        Route::resource('admin/category', CategoryController::class)->except(['show', 'create']);
        Route::resource('admin/post', PostController::class)->except(['show']);
        Route::resource('admin/transaction', TransactionController::class)->except(['create', 'edit', 'store', 'show']);
    });

});
