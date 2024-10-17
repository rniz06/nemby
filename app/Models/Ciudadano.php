<?php

namespace App\Models;

use App\Models\Expediente\Expediente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudadano extends Model
{
    use HasFactory;

    protected $table = "ciudadanos";

    protected $fillable = ['nombre', 'apellido', 'nombre_completo', 'ci', 'ruc', 'telefono', 'email', 'direccion_particular', 'tipo_persona', 'barrio_id', 'ciudad_id'];


    // Relacion uno a muchos con la tabla "barrios" a travez del campo "barrio_id" (un ciudadano pertenece a un barrio y una barrio puede tener varios ciudadanos)
    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }

    // Relacion uno a muchos con la tabla "ciudades" a travez del campo "ciudad_id" (un ciudadano pertenece a una ciudad y una ciudad puede tener varios ciudadanos)
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    // Relacion uno a muchos inversa con la tabla de expedientes
    // Un ciudadano puede tener varios expedientes
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }
}
