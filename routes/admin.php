<?php

use App\Http\Controllers\Admin\ArticuloController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EntradaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\SalidaController;

Route::resource('home', HomeController::class)->only(['index', 'edit', 'update'])->names('admin.home');
Route::resource('categoria', CategoryController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.categoria');
Route::resource('producto', ProductoController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.producto');
Route::resource('articulos', ArticuloController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.articulo');
Route::get('/admin/articulos/pdf', [ArticuloController::class, 'pdf'])->name('articulo.pdf');
Route::resource('entradas', EntradaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.entrada');
Route::get('/admin/entradas/pdf', [EntradaController::class, 'pdf'])->name('entrada.pdf');
Route::resource('persona', PersonaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.persona');
Route::resource('salida', SalidaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.salida');
Route::get('/admin/salidas/pdf', [SalidaController::class, 'pdf'])->name('salida.pdf');



