<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\TipoCategoriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/autenticacao', [LoginController::class, 'autenticacao'])->name('login.autenticacao');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

     Route::group(['prefix' => '/lancamentos', 'as' => 'lancamento.'], function() {
            Route::get('/', [LancamentoController::class, 'index'])->name('index');
            Route::get('/create', [LancamentoController::class, 'create'])->name('create');
            Route::post('/store', [LancamentoController::class, 'store'])->name('store');
            Route::put('/update/{id}', [LancamentoController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [LancamentoController::class, 'destroy'])->name('destroy');
        });

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

        Route::group(['prefix' => '/usuario', 'as' => 'usuario.'], function() {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => '/responsavel', 'as' => 'responsavel.'], function() {
            Route::get('/', [ResponsavelController::class, 'index'])->name('index');
            Route::post('/store', [ResponsavelController::class, 'store'])->name('store');
            Route::put('/update/{id}', [ResponsavelController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ResponsavelController::class, 'destroy'])->name('destroy');
        });
    });

});
