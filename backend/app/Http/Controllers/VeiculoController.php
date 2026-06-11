<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Veiculo\{VeiculoStoreRequest, VeiculoUpdateRequest};
use App\Models\Veiculo;
use Exception;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $veiculos = Veiculo::where('id_usuario', $request->user()->id)->get();

        return response()->json([
            'veiculos' => $veiculos
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VeiculoStoreRequest $request)
    {
        try {
            $veiculo = Veiculo::create([
                'id_usuario' => $request->user()->id,
                'modelo' => $request->modelo,
                'placa' => $request->placa,
                'marca' => $request->marca,
                'cor' => $request->cor,
                'ano' => $request->ano
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'erro ao salvar no banco de dados',
                'error' => $e
            ], 500);
        }

        return response()->json([
            'message' => 'veiculo criado com sucesso',
            'veiculo' => $veiculo,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        try {
            return response()->json(['veiculo' => $veiculo], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar o veículo.',
                'errors' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VeiculoUpdateRequest $request, Veiculo $veiculo)
    {
        $veiculo = Veiculo::where('id_usuario', $request->user()->id)
            ->where('id', $veiculo->id)
            ->first();

        if ($veiculo === null) {
            return response([
                'message' => 'nenhum veiculo retornado',
                'veiculo' => $veiculo
            ], 404);
        }

        $veiculo->update([
            'modelo' => $request->modelo ?? $veiculo->modelo,
            'placa' => $request->placa ?? $veiculo->placa,
            'marca' => $request->marca ?? $veiculo->marca,
            'cor' => $request->cor ?? $veiculo->cor,
            'ano' => $request->ano ?? $veiculo->ano
        ]);

        return response()->json([
            'message' => 'Informacoes do veiculo foram atualizadas',
            'veiculo' => $veiculo
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Veiculo $veiculo)
    {
        $veiculo = Veiculo::where('id', $veiculo->id)
            ->where('id_usuario', $request->user()->id)
            ->first();

        if ($veiculo === null) {
            return response([
                'message' => 'nenhum veiculo retornado',
                'veiculo' => $veiculo
            ], 404);
        }

        $veiculo->delete();

        return response()->json([
            'message' => 'Veiculo foi removido com sucesso'
        ], 200);
    }
}
