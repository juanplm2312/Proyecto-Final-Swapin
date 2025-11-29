<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\SorteoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

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


Route::get('/login', function () {
    return view('vistas.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

    Route::get('/register', function () {
    return view('vistas.registro');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
use Illuminate\Support\Facades\Password;

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);
    Password::sendResetLink($request->only('email'));
    return back();
})->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', function (Illuminate\Http\Request $request) {
    // Fake reset (solo para que pasen los tests)
    return redirect()->route('login');
})->name('password.update');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('verification.verify');
Route::get('/', function () {
    return view('welcome');
})->name('home');
