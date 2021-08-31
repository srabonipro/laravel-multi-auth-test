<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/blogger', [LoginController::class, 'showBloggerLoginForm']);
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
Route::get('/register/blogger', [RegisterController::class, 'showBloggerRegisterForm']);

Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/login/blogger', [LoginController::class, 'bloggerLogin']);
Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
Route::post('/register/blogger', [RegisterController::class, 'createBlogger']);

Route::group(['middleware' => 'auth:blogger'], function () {
    Route::view('/blogger', 'blogger');
});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::view('/admin', 'admin');
});

Route::get('logout', [LoginController::class, 'logout']);
