<?php

namespace App\Http\Controllers;

use App\Models\Estacionamento;
use Illuminate\Http\Request;
use App\Http\Requests\Estacionamento\{EstacionamentoStoreRequest, EstacionamentoUpdateRequest};
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
     * Store a newly created resource in storage.
     */
    public function store(EstacionamentoStoreRequest $request)
    {
        try {
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
    public function show(Estacionamento $estacionamento)
    {
        try {
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
     * Update the specified resource in storage.
     */
    public function update(EstacionamentoUpdateRequest $request, Estacionamento $estacionamento)
    {
        try {
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
    public function destroy(Estacionamento $estacionamento)
    {
        try {
            $estacionamento->delete();

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
