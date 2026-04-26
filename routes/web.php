<?php

use App\Http\Controllers\Auth\LoginController;
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
            Route::delete('/destroy/{id}', [TipoCategoriaController::class, 'destroy'])->name('destroy');
        });
    });

});
