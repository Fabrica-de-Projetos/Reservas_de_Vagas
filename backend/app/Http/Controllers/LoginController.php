<?php

namespace App\Http\Controllers;

use App\Exceptions\UsuarioNaoEncontradoException;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if ($usuario == false || Hash::check($request->senha, $usuario->senha) == false){
            return response()->json([
                'message' => 'Email ou senha inválidos.'
            ], 401);
        }

        return response()->json([
            'message' => 'Usuário autenticado com sucesso.',
            'usuario' => [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
            ]
        ], 200);
    }
}
