<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EstacionamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $estacionamentos = Estacionamento::all();

            return response()->json([
                'estacionamentos' => $estacionamentos
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar os estacionamentos.',
                'errors' => $th->getMessage()
            ], 500);
        }
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
                'nome' => ['required', 'string', 'max:100'],
                'rua' => ['required', 'string', 'max:100'],
                'numero' => ['required', 'string', 'max:10'],
                'bairro' => ['required', 'string', 'max:100'],
                'cep' => ['required', 'string', 'max:8'],
                'cidade' => ['required', 'string', 'max:50'],
                'estado' => ['sometimes', 'string', 'max:2'],
                'total_vagas' => ['required', 'integer']
            ]);

            $estacionamento = Estacionamento::create([
                'nome' => $request->nome,
                'rua' => $request->rua,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cep' => $request->cep,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'total_vagas' => $request->total_vagas
            ]);

            return response()->json([
                'message' => 'Estacionamento criado com sucesso!',
                'estacionamento' => $estacionamento
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->getMessage()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro interno no servidor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $estacionamento = Estacionamento::findOrFail($id);
            return response()->json([
                'estacionamento' => $estacionamento
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar o estacionamento.',
                'errors' => $th->getMessage()
            ], 404);
        }
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
        try {
            $estacionamento = Estacionamento::findOrFail($id);

            $request->validate([
                'nome' => ['sometimes', 'string', 'max:100'],
                'rua' => ['sometimes', 'string', 'max:100'],
                'numero' => ['sometimes', 'string', 'max:10'],
                'bairro' => ['sometimes', 'string', 'max:100'],
                'cep' => ['sometimes', 'string', 'max:8'],
                'cidade' => ['sometimes', 'string', 'max:50'],
                'estado' => ['sometimes', 'string', 'max:2'],
                'total_vagas' => ['sometimes', 'integer']
            ]);

            $estacionamento->update([
                'nome' => $request->nome ?? $estacionamento->nome,
                'rua' => $request->rua ?? $estacionamento->rua,
                'numero' => $request->numero ?? $estacionamento->numero,
                'bairro' => $request->bairro ?? $estacionamento->bairro,
                'cep' => $request->cep ?? $estacionamento->cep,
                'cidade' => $request->cidade ?? $estacionamento->cidade,
                'estado' => $request->estado ?? $estacionamento->estado,
                'total_vagas' => $request->total_vagas ?? $estacionamento->total_vagas
            ]);

            return response()->json([
                'message' => 'Estacionamento atualizado com sucesso!',
                'estacionamento' => $estacionamento
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->getMessage()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro interno no servidor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Estacionamento::destroy($id);

            return response()->json([
                'message' => 'Estacionamento excluído com sucesso!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluir o estacionamento.',
                'errors' => $th->getMessage()
            ], 204);
        }
    }
}
