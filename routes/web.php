<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;

Route::get('/', fn() => view('home'));
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('usuarios', UsuarioController::class)->names('usuarios');

