<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i < 10; $i++) {
            Usuario::create([
                'nome' => "Usuário $i",
                'email' => "usuario$i@email.com",
                'senha' => Hash::make('123456'),
            ]);
        }
        // Usuario::factory()->count(10)->create();
    }
}
