<?php

namespace Database\Seeders;

use App\Models\Veiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Veiculo::create([
                'id_usuario' => 1,
                'modelo' => 'sedã',
                'placa' => "AAA$i",
                'marca' => 'Toyota',
                'cor' => 'amarelo',
                'ano' => 2000 + $i
            ]);
        }
    }
}
