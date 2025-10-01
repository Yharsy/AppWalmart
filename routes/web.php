<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentaController;

Route::get('/', fn() => view('home'));
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('ventas', VentasControllerController::class);
Route::resource('clientes', ClientesControllerController::class);
Route::resource('stock', StockControllerControllerController::class);
Route::resource('usuarios', UsuarioController::class)->names('usuarios');

