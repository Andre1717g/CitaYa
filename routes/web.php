<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DoctorPerfilController;
use App\Http\Controllers\HorarioDoctorController;


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


// Mostrar formulario de horario
Route::get('/doctor/horario', function () {
    return view('doctor.horario'); // Asegúrate de que sea "horario.blade.php"
})->name('doctor.horario');

// Guardar horario
Route::get('/doctor/horario', [HorarioDoctorController::class, 'index'])->name('doctor.horario'); // Ver horarios
Route::post('/doctor/horario', [HorarioDoctorController::class, 'store'])->name('doctor.horario.store');


// Editar horario
Route::get('/doctor/horarios/{id}/editar', [HorarioDoctorController::class, 'edit'])->name('doctor.horarios.edit');
Route::put('/doctor/horarios/{id}', [HorarioDoctorController::class, 'update'])->name('doctor.horarios.update');

// Eliminar horario (ESTA ES LA QUE TE FALTA)
Route::delete('/doctor/horarios/{id}', [HorarioDoctorController::class, 'destroy'])->name('doctor.horarios.destroy');

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




/* POR SI TE SIRVEN USA ESTAS RUTAS
Route::get('/horarios/{doctor_id}', [HorarioDoctorController::class, 'index']);
Route::post('/horarios', [HorarioDoctorController::class, 'store']);

Route::get('/citas', [CitaController::class, 'index']);
Route::post('/citas', [CitaController::class, 'store']);
Route::put('/citas/{id}/confirmar', [CitaController::class, 'confirmar']);
Route::put('/citas/{id}/cancelar', [CitaController::class, 'cancelar']);
Route::put('/citas/{id}/finalizar', [CitaController::class, 'finalizar']);

Route::post('/historial', [HistorialMedicoController::class, 'store']);
Route::get('/historial/paciente/{paciente_id}', [HistorialMedicoController::class, 'showByPaciente']);
*/