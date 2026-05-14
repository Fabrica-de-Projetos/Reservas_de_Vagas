<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Reserva::create([
                'id_usuario' => rand(1, 5),
                'id_veiculo' => rand(1, 5),
                'id_vaga' => rand(1, 10),
                'data_inicio' => now()->addDays($i),
                'data_fim' => now()->addDays($i + 1),
            ]);
        }
    }
}
