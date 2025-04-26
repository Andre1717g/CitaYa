<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Lógica para autenticar al usuario (paciente o doctor)
    public function login(Request $request)
    {
        // Validar las credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'user_type' => 'required|in:patient,doctor'
        ]);

        // Determinar el guard (paciente o doctor)
        $guard = $credentials['user_type'] == 'patient' ? 'paciente' : 'doctor';
        
        // Ajustar las credenciales según el campo adecuado para la base de datos
        $authCredentials = [
            'correo_electronico' => $credentials['email'],
            'password' => $credentials['password']
        ];

        // Intentar la autenticación con el guard especificado
        if (Auth::guard($guard)->attempt($authCredentials, $request->remember)) {
            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();
            
            // Redirigir al dashboard correspondiente según el tipo de usuario
            return redirect()->route(
                $guard == 'paciente' ? 'paciente.inicio' : 'doctor.dashboard'
            );
        }

        // Si la autenticación falla, devolver un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Lógica para cerrar sesión
    public function logout(Request $request)
    {
        // Recorremos todos los guardias configurados para cerrar sesión
        $guards = array_keys(config('auth.guards'));
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        // Invalidar la sesión y regenerar el token para proteger contra CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al home
        return redirect('/');
    }
}
