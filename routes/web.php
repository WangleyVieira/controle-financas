<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TipoCategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/autenticacao', [LoginController::class, 'autenticacao'])->name('login.autenticacao');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


    Route::group(['prefix' => '/configuracao', 'as' => 'configuracao.'], function() {
        
        Route::group(['prefix' => '/tipo-categoria', 'as' => 'tipo_categoria.'], function() {
            Route::get('/', [TipoCategoriaController::class, 'index'])->name('index');
            Route::post('/store', [TipoCategoriaController::class, 'store'])->name('store');
            Route::put('/update/{id}', [TipoCategoriaController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [TipoCategoriaController::class, 'destroy'])->name('destroy');
        });

         Route::group(['prefix' => '/categoria', 'as' => 'categoria.'], function() {
            Route::get('/', [CategoriaController::class, 'index'])->name('index');
            Route::post('/store', [CategoriaController::class, 'store'])->name('store');
            Route::put('/update/{id}', [CategoriaController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CategoriaController::class, 'destroy'])->name('destroy');
        });
    });

});
