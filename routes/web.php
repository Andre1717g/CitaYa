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
Route::get('/registro-clinica', function () {
    return view('auth.clinics.register'); // auth/clinics/register.blade.php
})->name('clinics.register');

Route::get('/registro-paciente', function () {
    return view('auth.patient.register'); // auth/patient/register.blade.php
})->name('patient.register');

