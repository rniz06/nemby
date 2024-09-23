<?php

namespace App\Models\Expediente;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = "expediente_comentarios";

    protected $fillable = ['nombre_original', 'nombre_a_mostrar', 'ruta', 'tamano', 'tipo', 'descripcion', 'usuario_id', 'expediente_id',];

    // Relacion uno a muchos con la tabla "users" a travez del campo "usuario_id"
    // Un archivo debe ser agregado por un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relacion uno a muchos con la tabla "expedientes" a travez del campo "expediente_id"
    // Un archivo debe pertenecer a un expediente
    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'expediente_id');
    }
}
