<?php

namespace App\Models\Expediente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = "expediente_estados";

    protected $fillable = ['estado'];

    // Relacion uno a muchos inversa con la tabla de expediente_estados
    // Un estado puede estar presente en varios expedientes
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }
}
