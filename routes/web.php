<?php

use Illuminate\Support\Facades\Route;

// Ruta para la página principal personalizada
Route::get('/', function () {
    return view('home'); // Carga home.blade.php
})->name('home');

// Otras rutas...