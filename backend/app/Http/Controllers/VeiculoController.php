<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use Exception;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $veiculos = Veiculo::where('id_usuario',$request->user()->id)->get();

        return response()->json([
            'veiculos'=>$veiculos
        ]);
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
        $request->validate([
            'modelo' => 'required|string',
            'placa'=> 'required|string',
            'marca'=> 'required|string',
            'cor'=> 'required|string',
            'ano'=> 'required|digits:4'
        ]);

        try{
            $veiculo = Veiculo::create([
                'id_usuario'=> $request->user()->id,
                'modelo' => $request->modelo,
                'placa'=> $request->placa,
                'marca'=> $request->marca,
                'cor'=> $request->cor,
                'ano'=> $request->ano
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message'=>'erro ao salvar no banco de dados',
                'error'=> $e
            ]);
        }

        return response()->json([
            'message' => 'veiculo criado com sucesso',
            'veiculo' => $veiculo,
        ]);
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
