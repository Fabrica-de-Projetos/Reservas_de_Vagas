<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsuarioSeeder::class);
        $this->call(EstacionamentoSeeder::class);
        $this->call(VeiculoSeeder::class);
        $this->call(VagaSeeder::class);
        $this->call(ReservaSeeder::class);
    }
}
