<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'registerForm']);
Route::post('/register',[AuthController::class,'register']);

Route::post('/logout',[AuthController::class,'logout']);

Route::get('/admin',[ItemController::class,'admin'])->middleware('auth');
Route::post('/add',[ItemController::class,'store'])->middleware('auth');
Route::get('/edit/{id}',[ItemController::class,'edit'])->middleware('auth');
Route::post('/update/{id}',[ItemController::class,'update'])->middleware('auth');
Route::get('/delete/{id}',[ItemController::class,'delete'])->middleware('auth');

Route::get('/user',[ItemController::class,'user']);
Route::get('/get-items',[ItemController::class,'getItems']);

