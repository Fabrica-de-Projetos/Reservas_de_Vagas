<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UsuarioController, EstacionamentoController, ReservaController, VagaController, VeiculoController, LoginController};
/* 
! observação importante: rotas ganham prefixo de "/api" por estarem neste arquivo de api, logo, um exemplo de rota correta (por exemplo, para usuarios) aplicando este prefixo api sem o uso do domínio (http://localhostEvariados) seria: /api/spotLivre/usuarios (utilizadno verbo GET irá me retornar todos os usuários do sistema) e exemplo de rota completa: http://localhost/api/spotLivre/usuarios (verbo get aqui para retornar todos os usuários)
*/

Route::resource("/spotLivre/estacionamentos", EstacionamentoController::class);
Route::resource("/spotLivre/reservas", ReservaController::class);
Route::resource("/spotLivre/usuarios", UsuarioController::class);
Route::resource("/spotLivre/vagas", VagaController::class);
Route::resource("/spotLivre/veiculos", VeiculoController::class);
Route::post("/spotLivre/login", [LoginController::class, 'login']);