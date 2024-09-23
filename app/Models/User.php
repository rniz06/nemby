<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Expediente\Archivo;
use App\Models\Expediente\Comentario;
use App\Models\Expediente\Expediente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relacion uno a muchos inversa con la tabla de expediente campo agregado_por
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    // Relacion uno a muchos inversa con la tabla de expediente_comentarios
    // Un usuario puede realizar varios comentarios en un expediente o mas
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    // Relacion uno a muchos inversa con la tabla de expediente_archivos
    // Un usuario puede tener agregar varios archivos
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
