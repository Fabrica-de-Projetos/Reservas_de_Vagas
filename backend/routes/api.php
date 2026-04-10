<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UsuarioController, EstacionamentoController, ReservaController, VagaController, VeiculoController};

Route::resource("/spotLivre/estacionamentos", EstacionamentoController::class);
Route::resource("/spotLivre/reservas", ReservaController::class);
Route::resource("/spotLivre/usuarios", UsuarioController::class);
Route::resource("/spotLivre/vagas", VagaController::class);
Route::resource("/spotLivre/veiculos", VeiculoController::class);