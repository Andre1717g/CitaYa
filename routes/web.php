<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DoctorPerfilController;
use App\Http\Controllers\CitaController;


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

    Route::get('/paciente/perfil', [PacienteController::class, 'perfil'])->name('paciente.perfil');

    Route::get('/paciente/perfil/editar', [PacienteController::class, 'edit'])->name('paciente.perfil.editar');

    Route::put('/paciente/perfil', [PacienteController::class, 'update'])->name('paciente.perfil.update');

});
// En tu archivo routes/web.php
// Route::prefix('paciente')->name('paciente.')->middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('paciente.dashboard');  // Asegúrate de que esta vista existe
//     })->name('dashboard');
// });



Route::middleware(['auth:doctor'])->group(function () {
    Route::get('/doctor/citas', function () {
        return view('doctor.citas');
    })->name('doctor.citas');

    // Ruta para el perfil del doctor
    Route::get('/doctor/perfil', [DoctorController::class, 'perfil'])->name('doctor.perfil');

    // Ruta para mostrar la foto del doctor
    // Route::get('/doctor/{id}/foto', [DoctorController::class, 'mostrarFoto'])->name('doctor.foto');

// Mostrar el formulario de edición
Route::get('/doctor/perfil/editar', [DoctorPerfilController::class, 'edit'])->name('doctor.perfil.editar');

// Procesar la actualización
Route::put('/doctor/perfil/actualizar', [DoctorPerfilController::class, 'update'])->name('doctor.perfil.actualizar');

Route::get('/doctor/historial', function () {
    return view('doctor.historial');
})->name('doctor.historial');

});

Route::get('/medicos', [DoctorController::class, 'index'])->name('medicos');
/******************************************************** */
/*
Route::get('/medicos', function () {
    return view('medicos');
})->name('medicos'); */






// Route::get('/citas', function () {
//     return view('citas');
// })->name('citas');


// Route::get('/medicos', function () {
//     return view('medicos');
// })->name('medicos');

//Route::get('/doctor/citas', [CitaController::class, 'index'])->name('doctor.citas');


Route::get('/doctor/citas', [CitaController::class, 'index'])->name('doctor.citas');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
Route::get('/citas/{id}/confirmar', [CitaController::class, 'confirmar'])->name('citas.confirmar');
Route::get('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');
Route::get('/citas/{id}/finalizar', [CitaController::class, 'finalizar'])->name('citas.finalizar');
Route::put('/citas/{id}/reprogramar', [CitaController::class, 'reprogramar'])->name('citas.reprogramar');
