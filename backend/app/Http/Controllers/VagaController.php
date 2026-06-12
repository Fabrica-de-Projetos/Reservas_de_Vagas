<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use App\Http\Requests\Vaga\{VagaStoreRequest, VagaUpdateRequest};

class VagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $vagas = Vaga::all();

            return response()->json([
                'vagas' => $vagas
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao recuperar vagas.',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VagaStoreRequest $request)
    {
        try {
            $vaga = Vaga::create([
                'id_estacionamento' => $request->id_estacionamento,
                'numero' => $request->numero,
                'tipo' => $request->tipo
            ]);

            return response()->json([
                'message' => 'Vaga criada com sucesso!',
                'vaga' => $vaga
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro interno no servidor.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaga $vaga)
    {
        try {
            return response()->json(['vaga' => $vaga], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar a vaga.',
                'errors' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VagaUpdateRequest $request, Vaga $vaga)
    {
        try {
            $vaga->update([
                'id_estacionamento' => $request->id_estacionamento ?? $vaga->id_estacionamento,
                'numero' => $request->numero ?? $vaga->numero,
                'tipo' => $request->tipo ?? $vaga->tipo
            ]);

            return response()->json(
                [
                    'message' => 'Vaga atualizada com sucesso!',
                    'vaga' => $vaga
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro interno no servidor',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaga $vaga)
    {
        try {
            $vaga->delete();

            return response()->json(['message' => 'Vaga excluída com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluír a vaga.',
                'errors' => $th->getMessage()
            ], 204);
        }
    }
}
