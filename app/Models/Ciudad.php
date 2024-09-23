<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = "ciudades";

    protected $fillable = ['ciudad'];

    // Relacion uno a muchos inversa con la tabla de barrios
    public function barrios()
    {
        return $this->hasMany(Barrio::class);
    }

    // Relacion uno a muchos inversa con la tabla de ciudadanos
    public function ciudadanos()
    {
        return $this->hasMany(Ciudadano::class);
    }
}
