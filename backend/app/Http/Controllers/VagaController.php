<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_estacionamento' => 'required|integer',
                'numero' => [
                    'required',
                    'integer',
                    Rule::unique('vagas')->where(function ($query) use ($request) {
                        return $query->where('id_estacionamento', $request->id_estacionamento);
                    }),
                ],
                'tipo' => 'required'
            ]);

            $vaga = Vaga::create([
                'id_estacionamento' => $request->id_estacionamento,
                'numero' => $request->numero,
                'tipo' => $request->tipo
            ]);

            return response()->json([
                'message' => 'Vaga criada com sucesso!',
                'vaga' => $vaga
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->getMessage()
            ], 422);
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
    public function show(string $id)
    {
        try {
            $vaga = Vaga::findOrFail($id);

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
    public function update(Request $request, string $id)
    {
        try {
            $vaga = Vaga::findOrFail($id);

            $request->validate([
                'id_estacionamento' => 'sometimes|integer',
                'numero' => 'sometimes|integer',
                'tipo' => 'sometimes|required'
            ]);

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
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $e->getMessage()
            ], 422);
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
    public function destroy(string $id)
    {
        try {
            Vaga::destroy($id);

            return response()->json(['message' => 'Vaga excluída com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluír a vaga.',
                'errors' => $th->getMessage()
            ], 204);
        }
    }
}
