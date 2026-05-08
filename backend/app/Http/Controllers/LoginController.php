<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Carbon\Carbon;
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
        
        /*Com essa linha, vou criar o token que do Usuario que será valido por (ESTOU DEFININDO) minutos*/
        $token = $usuario->createToken('auth_token', ['*'], Carbon::now()->addMinutes(5))->plainTextToken;
        
        return response()->json([
            'message' => 'Usuário autenticado com sucesso.',
            'token' => $token,
            'type' => 'bearer'
        ], 200);
    }
}
