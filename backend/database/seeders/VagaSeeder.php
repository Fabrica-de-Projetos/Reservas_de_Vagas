<?php

namespace Database\Seeders;

use App\Models\Vaga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) { 
            Vaga::create([
                'id_estacionamento' => rand(1,10),
                'numero' => 50,
                'tipo' => 'normal'
            ]);
        }
    }
}
