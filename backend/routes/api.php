<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UsuarioController, EstacionamentoController, ReservaController, VagaController, VeiculoController, LoginController};
/* 
! observação importante: rotas ganham prefixo de "/api" por estarem neste arquivo de api, logo, um exemplo de rota correta (por exemplo, para usuarios) aplicando este prefixo api sem o uso do domínio (http://localhostEvariados) seria: /api/spotLivre/usuarios (utilizadno verbo GET irá me retornar todos os usuários do sistema) e exemplo de rota completa: http://localhost/api/spotLivre/usuarios (verbo get aqui para retornar todos os usuários)
*/

Route::apiResource("/spotLivre/estacionamentos", EstacionamentoController::class);
Route::apiResource("/spotLivre/reservas", ReservaController::class);
Route::apiResource("/spotLivre/usuarios", UsuarioController::class);
Route::apiResource("/spotLivre/vagas", VagaController::class);

/*Rota para verificacao do usuario*/
Route::post("/spotLivre/login", [LoginController::class, 'login']);

/*Rota para veiculos*/
Route::middleware('auth:sanctum')->Resource("/spotLivre/veiculos", VeiculoController::class);

Route::get("/spotLivre/reservas/horarios-disponiveis/{id}", [ReservaController::class, 'horariosDisponiveis']);