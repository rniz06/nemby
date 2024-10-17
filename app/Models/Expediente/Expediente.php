<?php

namespace App\Models\Expediente;

use App\Models\Ciudadano;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $table = "expedientes";

    protected $fillable = ['asunto', 'n_mesa_entrada', 'estado_id', 'agregado_por', 'ciudadano_id', 'departamento_id'];

    // Relacion uno a muchos con la tabla "expediente_estados" a travez del campo "estado_id"
    // Un expediente debe tener un solo estado
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    // Relacion uno a muchos con la tabla "users" a travez del campo "agregado_por"
    // un expediente debe ser agregado por un usuario
    public function agregadoPor()
    {
        return $this->belongsTo(User::class, 'agregado_por');
    }

    // Relacion uno a muchos con la tabla "ciudadanos" a travez del campo "ciudadano_id"
    // un expediente debe pertenecer a un solo ciudadano
    public function ciudadano()
    {
        return $this->belongsTo(Ciudadano::class, 'ciudadano_id');
    }

    // Relacion uno a muchos con la tabla "departamentos" a travez del campo "departamento_id"
    // un expediente debe estar en un solo departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    // Relacion uno a muchos inversa con la tabla de expediente_comentarios
    // Un expediente puede tener varios comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    
    // Relacion uno a muchos inversa con la tabla de expediente_archivos
    // Un expediente puede tener varios archivos
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
