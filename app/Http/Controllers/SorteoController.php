<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SorteoController extends Controller
{
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
}

    // ============================
    // 🔐 LOGIN
    // ============================
    public function login(Request $request)
    {
        // Validar datos
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Autenticar
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect('/');   // Va a la página protegida
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    // ============================
    // 📝 REGISTRO
    // ============================
    public function register(Request $request)
    {
        // Validar inputs
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Crear usuario
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Loguearlo automáticamente
        Auth::login($user);

        return redirect('/'); // Redirige al home protegido
    }

    // ============================
    // 🏠 PÁGINA PRINCIPAL
    // ============================
    public function index()
    {
        return view('vistas.index'); // Cambia según tu vista
    }
}
