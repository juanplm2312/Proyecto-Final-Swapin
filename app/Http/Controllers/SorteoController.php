<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SorteoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function login(Request $request)
{
    // Validar
    $credentials = $request->validate([
        'correo' => 'required|email',
        'password' => 'required',
    ]);

    // Intentar login
    if (Auth::attempt(['correo' => $request->correo, 'password' => $request->password])) {
    $request->session()->regenerate();
    return redirect()->intended('/index');
}

    // Si falla
    return back()->withErrors([
    'correo' => 'Las credenciales no son válidas.',
]);
}

    public function index()
    {
        return view('vistas.index_principal');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
