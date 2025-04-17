<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

// Ruta principal (Home)
Route::get('/', function () {
    return view('home');
})->name('home');

