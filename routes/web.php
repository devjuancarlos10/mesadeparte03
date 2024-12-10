<?php

use Illuminate\Support\Facades\Route;

// Ruta de inicio (home)
Route::get('/', function () {
    return view('welcome');
});

Route::get("/user", function() {
    return view('user');
});

Route::get("/secretary", function() {
    return view("secretary");
});


Route::get("/publicOfficer", function(){
    return view("publicOfficer");
});


use App\Http\Controllers\RegistroController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use App\Models\Usuario;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('correo', [RegistroController::class, 'mostrarCorreo'])->name('registro.correo');
    Route::post('enviar-codigo', [RegistroController::class, 'enviarCodigo'])->name('enviar.codigo');
    Route::get('verificar-codigo', [RegistroController::class, 'mostrarCodigo'])->name('verificar.codigo');
    Route::post('verificar-codigo', [RegistroController::class, 'verificarCodigo'])->name('verificarCodigo');
    Route::get('datos', [RegistroController::class, 'mostrarDatos'])->name('registro.datos');
    Route::post('datos', [RegistroController::class, 'guardarDatos']);
    Route::get('contrasenia', [RegistroController::class, 'mostrarContrasenia'])->name('crear.contrasenia');
    Route::post('contrasenia', [RegistroController::class, 'crearCuenta']);
    Route::get('/registro', [RegistroController::class, 'mostrarFormulario'])->name('registro');
    Route::get('login', [LoginController::class, 'create'])->name('login');  // Mostrar formulario de login
    Route::post('login', [LoginController::class, 'store']);  // Procesar formulario de login
    Route::post('/verificar-correo', [RegistroController::class, 'verificarCorreo'])->name('verificar.correo');
});

// Rutas protegidas para usuarios autenticados

Route::middleware('auth')->group(function () {
    Route::get('/welcome', [DashboardController::class, 'index'])->name('welcome');
});

Route::get('/password/forgot', function () {
    return view('recuperarContrasenia');
})->name('password.email.view');

Route::post('/password/forgot', [LoginController::class, 'enviarCodigo'])->name('password.email');

Route::get('/password/code', function () {
    return view('codigoRecuperacion');
})->name('password.code.view');

Route::post('/password/code', [LoginController::class, 'verificarCodigo'])->name('password.verify.code');

Route::get('/password/reset', function () {
    return view('nuevaContrasenia');
})->name('password.reset.view');

Route::post('/password/reset', [LoginController::class, 'actualizarContraseña'])->name('password.update.custom');

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

