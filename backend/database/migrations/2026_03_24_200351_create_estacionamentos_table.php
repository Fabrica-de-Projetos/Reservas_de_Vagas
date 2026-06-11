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
        Schema::create('estacionamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('rua', 100);
            $table->string('numero', 10);
            $table->string('bairro', 100);
            $table->string('cep', 20);
            $table->string('cidade', 50);
            $table->string('estado', 2);
            $table->integer('total_vagas');
            $table->string('imagem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estacionamentos');
    }
};
