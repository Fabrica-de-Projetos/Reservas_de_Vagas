<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservas = Reserva::all();

            return response()->json([$reservas], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Não foi possível recuperar as reservas.",
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
                'id_usuario' => 'required|integer|exists:usuarios,id',
                'id_veiculo' => 'required|integer|exists:veiculos,id',
                'id_vaga' => 'required|integer|exists:vagas,id',
                'data_inicio' => 'required|date',
                'data_fim' => 'required|date'
            ]);

            $reserva = Reserva::create([
                'id_usuario' => $request->id_usuario,
                'id_veiculo' => $request->id_veiculo,
                'id_vaga' => $request->id_vaga,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim
            ]);

            return response()->json([
                'message' => 'Reserva realizada com sucesso!',
                'reserva' => $reserva
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->getMessage()
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro interno no servidor',
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
            $reserva = Reserva::findOrFail($id);

            return response()->json([$reserva], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar a reserva.',
                'errors' => $th->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $reserva = Reserva::findOrFail($id);

            $request->validate([
                'id_usuario' => 'nullable|integer|exists:usuarios,id',
                'id_veiculo' => 'nullable|integer|exists:veiculos,id',
                'id_vaga' => 'nullable|integer|exists:vagas,id',
                'data_inicio' => 'nullable|date|before:data_fim',
                'data_fim' => 'nullable|date|after:data_inicio'
            ]);

            $reserva->update([
                'id_usuario' => $request->id_usuario ?? $reserva->id_usuario,
                'id_veiculo' => $request->id_veiculo ?? $reserva->id_veiculo,
                'id_vaga' => $request->id_vaga ?? $reserva->id_vaga,
                'data_inicio' => $request->data_inicio ?? $reserva->data_inicio,
                'data_fim' => $request->data_fim ?? $reserva->data_fim
            ]);

            return response()->json([
                'message' => 'Reserva atualizada com sucesso.',
                'reserva' => $reserva
                ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->getMessage()
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro interno no servidor',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Reserva::destroy($id);

            return response()->json(['message' => 'Reserva excluída com sucesso.'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluir a reserva.',
                'errors' => $th->getMessage()
            ], 204);
        }
    }
}
