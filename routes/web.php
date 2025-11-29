<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\SorteoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;

// =====================================
// 🔐 RUTAS SOLO PARA INVITADOS
// =====================================
Route::middleware('guest')->group(function () {

    // Login (mostrar)
    Route::get('/login', function () {
        return view('vistas.login');
    })->name('login');

    // Login (procesar)
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    // Registro (mostrar)
    Route::get('/register', function () {
        return view('vistas.registro');
    })->name('register');

    // Registro (procesar)
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    // Recuperar contraseña
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Illuminate\Http\Request $request) {
        $request->validate(['email' => 'required|email']);
        Password::sendResetLink($request->only('email'));
        return back();
    })->name('password.email');

    // Reset password
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function () {
        return redirect()->route('login');
    })->name('password.update');
});


// =====================================
// 🔒 RUTAS PARA USUARIOS AUTENTICADOS
// =====================================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Página principal
    Route::get('/', [SorteoController::class, 'index'])->name('home');

    Route::get('/Inicio', [SorteoController::class, 'index']);

    Route::view('/dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    // Ajustes Fortify
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
});


// =====================================
// Email Verification
// =====================================
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function () {
    return redirect()->route('home');
})
->middleware('auth')
->name('verification.verify');
