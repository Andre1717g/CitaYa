<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'user_type' => 'required|in:patient,doctor'
        ]);

        $guard = $credentials['user_type'] == 'patient' ? 'paciente' : 'doctor';
        
        // Modificamos las credenciales para usar el campo correcto
        $authCredentials = [
            'correo_electronico' => $credentials['email'],
            'password' => $credentials['password'] // Aunque el campo se llame 'contraseña'
        ];

        if (Auth::guard($guard)->attempt($authCredentials, $request->remember)) {
            $request->session()->regenerate();
            
            return redirect()->intended(
                $guard == 'paciente' ? '/paciente/dashboard' : '/doctor/dashboard'
            );
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $guards = array_keys(config('auth.guards'));
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}