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
        'departamento_id',
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

    /**
     * Obtiene los expedientes asociados al usuario.
     *
     * Este método define una relación de uno a muchos donde un usuario puede tener múltiples expedientes.
     */
    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    /**
     * Obtiene los comentarios asociados a los expedientes del usuario.
     *
     * Este método define una relación de uno a muchos donde un usuario puede realizar múltiples comentarios
     * en uno o más expedientes.
     */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    /**
     * Obtiene los archivos asociados a los expedientes del usuario.
     *
     * Este método define una relación de uno a muchos donde un usuario puede adjuntar múltiples archivos
     * a sus expedientes.
     */
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    /**
     * Obtiene el departamento al que pertenece el usuario.
     *
     * Este método define una relación de muchos a uno donde un usuario pertenece a un único departamento
     * indicado por el campo 'departamento_id'.
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
}
