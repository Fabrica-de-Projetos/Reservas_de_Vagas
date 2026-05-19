<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservaSeeder extends Seeder
{
    public function run(): void
    {
        $horarios = [
            "08:00",
            "09:30",
            "11:00",
            "12:30",
            "14:00",
            "15:30",
            "17:00",
            "18:30",
            "19:30"
        ];

        for ($i = 0; $i < 10; $i++) {

            $horarioEscolhido = $horarios[array_rand($horarios)];

            $inicio = Carbon::parse(
                now()->addDays($i)->format('Y-m-d') . ' ' . $horarioEscolhido
            );

            $fim = $inicio->copy()->addHour()->addMinutes(30);

            Reserva::create([
                'id_usuario' => rand(1, 5),
                'id_veiculo' => rand(1, 5),
                'id_vaga' => rand(1, 10),

                'data_inicio' => $inicio,
                'data_fim' => $fim,
            ]);
        }
    }
}
