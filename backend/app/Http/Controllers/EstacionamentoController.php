<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstacionamentoController extends Controller
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
           $validated = $request->validate([
        'nome'        => 'required|string|max:255',
        'rua'         => 'required|string|max:255',
        'numero'      => 'required|string|max:10',
        'bairro'      => 'required|string|max:255',
        'cep'         => 'required|string|size:8',
        'cidade'      => 'required|string|max:255',
        'estado'      => 'required|string|size:2',
        'total_vagas' => 'required|integer|min:1',
    ]);

    $estacionamento = Estacionamento::create($validated);

    return response()->json([
        'message' => 'Estacionamento criado com sucesso!',
        'data' => $estacionamento
    ], 201);
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
        $estacionamento = Estacionamento::findOrFail($id);

        $data = $request->validate([
        'nome'        => 'sometimes|string|max:255',
        'rua'         => 'sometimes|string|max:255',
        'numero'      => 'sometimes|string|max:20',
        'bairro'      => 'sometimes|string|max:255',
        'cep'         => 'sometimes|string|max:10',
        'cidade'      => 'sometimes|string|max:255',
        'estado'      => 'sometimes|string|max:2',
        'total_vagas' => 'sometimes|integer|min:1',
    ]);

    $estacionamento->update([
        'nome'        => $request->nome        ?? $estacionamento->nome,
        'rua'         => $request->rua         ?? $estacionamento->rua,
        'numero'      => $request->numero      ?? $estacionamento->numero,
        'bairro'      => $request->bairro      ?? $estacionamento->bairro,
        'cep'         => $request->cep         ?? $estacionamento->cep,
        'cidade'      => $request->cidade      ?? $estacionamento->cidade,
        'estado'      => $request->estado      ?? $estacionamento->estado,
        'total_vagas' => $request->total_vagas ?? $estacionamento->total_vagas,
    ]);

   



        return response()->json([
            'message' => 'Estacionamento atualizado com sucesso',
            'data' => $estacionamento
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $estacionamento = Estacionamento::findOrFail($id);
            $estacionamento->delete();

        return response()->json([
            'message' => 'Registro removido com sucesso'
        ], 200);

    }
    
    catch (ModelNotFoundException $e) {
        return response()->json([
            'erro' => 'Estacionamento não encontrado para o ID informado.'
        ], 404);
    }
    }
}
