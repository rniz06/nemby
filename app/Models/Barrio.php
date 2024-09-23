<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $table = "barrios";

    protected $fillable = ['barrio', 'ciudad_id'];

    // Relacion uno a muchos con la tabla "ciudades" a travez del campo "ciudad_id"
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    // Relacion uno a muchos inversa con la tabla de ciudadanos
    public function ciudadanos()
    {
        return $this->hasMany(Ciudadano::class);
    }
}
