<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware(['auth:api'])->group(function () {
     Route::post('/logout', [LogoutController::class, 'logout']);

     Route::middleware(['isAdmin'])->group(function(){
        Route::resource('admin/user', UserController::class)->except(['show', 'create']);
        Route::resource('admin/category', CategoryController::class)->except(['show', 'create']);
        // Route::resource('admin/post', PostController::class)->except(['show']);
        Route::resource('admin/transaction', TransactionController::class)->except(['create', 'edit', 'store', 'show']);
    });

});
