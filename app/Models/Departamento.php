<?php

namespace App\Models;

use App\Models\Expediente\Expediente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = "departamentos";

    protected $fillable = ['departamento'];

    /**
     * Relación uno a muchos inversa con la tabla de expedientes.
     *
     * Un departamento puede tener varios expedientes asociados.
     */
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    /**
     * Relación uno a muchos con la tabla de usuarios.
     *
     * Un departamento puede tener varios usuarios asociados.
     */
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
