<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;

//? Raiz del directorio
Route::get('/', function () {
    return redirect('/seguridad/login');
});

//? Rutas para el Login
Route::get('/seguridad/login', [LoginController::class, 'login'])->name('login');
Route::post('/seguridad/login/acceso', [LoginController::class, 'acceso'])->name('login.acceso');

//!Rutas para el recovery en una sola vista de blade
Route::get('/recuperar-password', [LoginController::class, 'recuperarPassword'])->name('recuperar_password');
Route::get('/recuperar-password/email', [LoginController::class, 'postEmail'])->name('post.email');
Route::get('/recuperar-password/codigo', [LoginController::class, 'postCodigo'])->name('post.codigo');
Route::get('/recuperar-password/password', [LoginController::class, 'postPassword'])->name('post.password');

//? Rutas protegidas por middleware para mostrar solo a usuarios conectados.
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('usuario')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('usuario.index');
        Route::get('/editar/{id}', [UsuarioController::class, 'edit'])->name('usuario.edit');
        Route::put('/actualizar/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
    });
});
