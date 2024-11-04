<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = "expediente_movimientos";

    protected $fillable = ['expediente_id', 'departamento_origen_id', 'departamento_destino_id', 'estado', 'comentario_envio', 'comentario_rechazo', 'usuario_id'];
}
