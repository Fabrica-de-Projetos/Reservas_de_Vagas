<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function login(Request $request)
    {
        // Lógica de autenticação do usuário
        $credentials = $request->only('email', 'senha');
        $usuario = Usuario::where('email', $credentials['email'])->first();
        if (!$usuario || !Hash::check($credentials['senha'], $usuario->senha)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        // Request.Only("email", "password");
        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            return response()->json(['message' => 'Login successful']);
        } else  {
            // Autenticação falhou
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
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