<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

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
Route::get('/register/patient', function () {
    return view('auth.patient-registration');
})->name('patient.register');


// Registro de doctor
Route::get('/register/doctor', function () {
    return view('auth.doctor-registry');
})->name('doctor.register');
/******************************************************** */

Route::get('/medicos', function () {
    return view('auth.medicos');
})->name('medicos');

// Route::get('/medicos', function () {
//     return view('medicos');
// })->name('medicos');
