<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = [
        'id_usuario',
        'modelo',
        'placa',
        'marca',
        'cor',
        'ano'
    ];
}
