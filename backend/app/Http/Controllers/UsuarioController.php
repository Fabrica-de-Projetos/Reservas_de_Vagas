<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\UsuarioStoreRequest;
use App\Http\Requests\usuario\UsuarioUpdateRequest;
use Illuminate\Http\Request;
// namespace que me permite usar método de criptografia de senha em hash
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuarios = Usuario::all();
            return response()->json(['usuarios' => $usuarios], 200);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'message' => 'Erro ao recuperar usuários',
                    'error' => $e->getMessage(),
                ],
                500
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioStoreRequest $request)
    {
        try {
            Usuario::create([
                'nome' => $request->nome_usuario,
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
            ]);

            /*A api não vai retornar mais os dados do usuario, ela vai retornar só o token, que vai deixar a comunicação da API com o front mais segura*/
            return response()->json([
                'message' => 'Usuário criado com sucesso'
            ], 201);

        } catch (ValidationException $e) { // se der um erro do tipo "ValidationException" cai nesse catch
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->getMessage()
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
    public function show(Usuario $usuario)
    {
        try {
            return response()->json([
                'usuario' => $usuario
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar o usuário.',
                'errors' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * ! lembrar os meninos de aplicar o método PATCH nesse aqui, permitindo alteração parcial dos valores passados
     */
    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        try {
            $usuario->update([
                'nome' => $request->nome_usuario ?? $usuario->nome,
                'email' => $request->email ?? $usuario->email,
                'senha' => $request->senha ? Hash::make($request->senha) : $usuario->senha
            ]);

            return response()->json([
                'message' => 'Usuário atualizado com sucesso!',
                'usuario' => $usuario
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erro de validação.',
                'errors' => $e->getMessage()
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro interno no servidor.',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        try {
            $usuario->delete();

            return response()->json(['message' => 'Usuário excluído com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluír o usuário.',
                'erros' => $th->getMessage()
            ], 204);
        }
    }
}
