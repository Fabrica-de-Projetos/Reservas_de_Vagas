<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reserva\ReservaStoreRequest;
use App\Http\Requests\Reserva\ReservaUpdateRequest;
use App\Models\{
    Reserva,
    Vaga,
    Usuario,
    Veiculo
};
use Carbon\Carbon;
use Nette\Schema\ValidationException;

class ReservaController extends Controller
{

    protected function encontraHorariosIndisponiveis(Vaga $vaga): array
    {
        // trazendo os registros da tabela reserva onde o valor da coluna id_vaga da tabela reservas corresponde com o valor que passamos de parâmetro ($idVaga)
        // se ele tá me retornando alguma coisa, significa que eu tenho horários reservados relacionado a aquela vaga 
        // toda consulta SQL (com where e etc precisa do ->get para que eu pegue os valores daquela consulta no banco)
        $reservasAtivas = Reserva::where('id_vaga', $vaga->id)->get();
        $horariosIndisponiveis = [];

        // pegando os horários que NÃO posso reservar
        foreach ($reservasAtivas as $reservaAtiva) {
            $horariosIndisponiveis[] = Carbon::parse($reservaAtiva->data_inicio)->format('H:i');
        }

        return $horariosIndisponiveis;
    }

    protected function encontraHorariosDisponiveis(array $horariosIndisponiveis): array
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

        $horariosDisponiveis = [];


        foreach ($horarios as $horario) {
            if (!in_array($horario, $horariosIndisponiveis)) {
                $horariosDisponiveis[] = $horario;
            }
        }

        return $horariosDisponiveis;
    }

    public function horariosDisponiveis(Vaga $vaga)
    {
        try {
            $horariosIndisponiveis = $this->encontraHorariosIndisponiveis($vaga);
            $horariosDisponiveis = $this->encontraHorariosDisponiveis($horariosIndisponiveis);

            return response()->json([
                'horariosDisponiveis' => $horariosDisponiveis,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar as reservas.',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservas = Reserva::all();

            return response()->json(['reservas' => $reservas], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Não foi possível recuperar as reservas.",
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function reservar(ReservaStoreRequest $request, Usuario $usuario, Veiculo $veiculo, Vaga $vaga)
    {
        try {
            $reserva = Reserva::create([
                'id_usuario' => $usuario->id,
                'id_veiculo' => $veiculo->id,
                'id_vaga' => $vaga->id,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim
            ]);

            return response()->json([
                'message' => 'Reserva realizada com sucesso!',
                'reserva' => $reserva
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro interno no servidor',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        try {
            return response()->json(['reserva' => $reserva], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível recuperar a reserva.',
                'errors' => $th->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function atualizar(ReservaUpdateRequest $request, Reserva $reserva)
    {
        try {
            $reserva->update([
                'id_usuario' => $request->id_usuario ?? $reserva->id_usuario,
                'id_veiculo' => $request->id_veiculo ?? $reserva->id_veiculo,
                'id_vaga' => $request->id_vaga ?? $reserva->id_vaga,
                'data_inicio' => $request->data_inicio ?? $reserva->data_inicio,
                'data_fim' => $request->data_fim ?? $reserva->data_fim
            ]);

            return response()->json([
                'message' => 'Reserva atualizada com sucesso.',
                'reserva' => $reserva
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro interno no servidor',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        try {
            $reserva->delete();

            return response()->json(['message' => 'Reserva excluída com sucesso.'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Não foi possível excluir a reserva.',
                'errors' => $th->getMessage()
            ], 204);
        }
    }
}
