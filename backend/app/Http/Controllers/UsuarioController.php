<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// namespace que me permite usar método de criptografia de senha em hash
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use League\Config\Exception\ValidationException;

class UsuarioController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:100',
                'email' => 'required|email|unique:usuarios,email',
                'senha' => 'required|min:6',
                'telefone' => 'required|string|min:14|max:15|unique:usuarios,telefone', //minimo de 15 caracteres devido a ddd e máscara de formatação (xx) xxxx-xxxx
                'cidade' => 'required|string|max:50',
                'estado' => 'required|string|max:2'
            ]);

            $usuario = Usuario::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'telefone' => $request->telefone,
                'cidade' => $request->cidade,
                'estado' => $request->estado
            ]);

            return response()->json([
                'message' => 'Usuário criado com sucesso',
                'data' => $usuario
            ], 201);
        } catch (ValidationException $e) { // se der um erro do tipo "ValidationException" cai nesse catch
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $e) { // qualquer outro tipo de erro, exceção no try que implemente a interface "Throwable" cai aqui
            return response()->json([
                'message' => 'Erro interno no servidor.',
                'error' => $e->getMessage()  // tacando o erro 100% crú msm por enquanto
            ], 500);
        }
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
