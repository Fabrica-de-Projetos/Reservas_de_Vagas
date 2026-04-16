<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            // criando a coluna id_usuario e vinculando seu valor a coluna id da tabela usuarios (constrained(`usuarios`)), o valor de `id_usuario` é equivalente ao valor 'id' da tabela 'usuarios' por causa do (foreignId)
            $table->foreignId('id_usuario')->constrained('usuarios');
            $table->string('modelo', 50);
            // dois carros no banco de dados com a mesma placa é no mínimo suspeito
            $table->string('placa', 10)->unique();
            $table->string('marca', 50);
            $table->string('cor', 15);
            $table->string('ano', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
