<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\SorteoController;
use Illuminate\Support\Facades\Auth;


// =============================
// 🔐 RUTAS DE AUTENTICACIÓN (solo invitados)
// =============================
Route::middleware('guest')->group(function () {

    // Mostrar login
    Route::get('/login', function () {
        return view('vistas.login');
    })->name('login');

    // Procesar login
    Route::post('/login', [SorteoController::class, 'login'])->name('login.post');

    // Mostrar registro
    Route::get('/registro', function () {
        return view('vistas.registro');
    })->name('registro');

    // Procesar registro
    Route::post('/registro', [SorteoController::class, 'registrar'])->name('registro.post');
});


// =============================
// 🔒 RUTAS PROTEGIDAS POR LOGIN
// =============================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    // Página principal
    Route::get('/', [SorteoController::class, 'index'])->name('home');

    // Otra ruta opcional
    Route::get('/Inicio', [SorteoController::class, 'index']);

    // Dashboard
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    // Ajustes
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            )
        )
        ->name('two-factor.show');
});
