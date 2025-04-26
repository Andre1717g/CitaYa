<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\LoginController;

// Ruta principal
Route::get('/', function () {
    return view('home');
})->name('home');



// Ruta para la página de selección de tipo de registro
Route::get('/tipo-registro', function () {
    return view('auth.register-type'); // Correcto: está en auth/
})->name('register.type');

// Rutas para formularios (consistentes con tu estructura de carpetas)
/******************************************************** */
// Ruta para el login de inicio de sesión
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Ruta para el registro de paciente
Route::get('/register/patient', [PacienteController::class, 'create'])->name('patient.register');
Route::post('/register/patient', [PacienteController::class, 'store'])->name('patient.store');

// Registro de doctor
/*Route::get('/register/doctor', function () {
    return view('auth.doctor-registry');
})->name('doctor.register');*/

Route::get('/register/doctor', [DoctorController::class, 'create'])->name('doctor.register');
Route::post('/register/doctor', [DoctorController::class, 'store'])->name('doctor.store');


// Sistema de Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Áreas protegidas
Route::middleware(['auth:paciente'])->group(function () {
    Route::get('/paciente/inicio', function () {
        return view('paciente.inicio');
    })->name('paciente.inicio');
});
// En tu archivo routes/web.php
// Route::prefix('paciente')->name('paciente.')->middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('paciente.dashboard');  // Asegúrate de que esta vista existe
//     })->name('dashboard');
// });



Route::middleware(['auth:doctor'])->group(function () {
    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');
});
/******************************************************** */

Route::get('/medicos', function () {
    return view('medicos');
})->name('medicos');


// Route::get('/citas', function () {
//     return view('citas');
// })->name('citas');


// Route::get('/medicos', function () {
//     return view('medicos');
// })->name('medicos');