<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserAtivoController extends Controller
{
    public function UserAtivo(Request $request)
    {
        return response()->json([
            'usuario' => $request->user()
        ]);
    }
}

?>
