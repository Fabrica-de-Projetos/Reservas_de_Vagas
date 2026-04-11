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
        for($i = 0; $i < 10; $i++) {
            Usuario::create([
                'nome' => "Usuário $i",
                'email' => "usuario$i@email.com",
                'senha' => Hash::make('123456'),
                'telefone' => '$i4 9999-0000',
                'cidade' => 'Marília',
                'estado' => 'SP'
            ]);
        }
        // Usuario::factory()->count(10)->create();
    }
}
