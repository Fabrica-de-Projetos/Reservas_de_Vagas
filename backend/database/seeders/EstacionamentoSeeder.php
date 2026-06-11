<?php

namespace Database\Seeders;

use App\Models\Estacionamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstacionamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) { 
            Estacionamento::create([
                'nome' => "Estacionamento $i",
                'rua' => "Rua teste $i",
                'numero' => $i,
                'bairro' => "Bairro teste $i",
                'cep' => '182349-987',
                'cidade' => 'Marília',
                'estado' => 'SP',
                'total_vagas' => $i * 5,
                'imagem' => 'estacionamentos/img-padrao.jpg'
            ]);
        }
    }
}
