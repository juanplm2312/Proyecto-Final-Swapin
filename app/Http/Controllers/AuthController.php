<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ===========================
    // LOGIN
    // ===========================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->route('home');   // ✔️ requerido por tests
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas'
        ]);
    }

    // ===========================
    // REGISTRO
    // ===========================
    public function register(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'email'    => $request->email,
            'name'     => $request->name,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('home');   // ✔️ requerido por tests
    }

    // ===========================
    // LOGOUT
    // ===========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); 
    }
}
