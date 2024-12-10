<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Asegúrate de usar esta clase
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios'; // Define la tabla asociada al modelo
    protected $primaryKey = 'idUsuario'; // Define la clave primaria si no es 'id'

    protected $fillable = [
        'nombres',
        'apellidos',
        'correo',
        'contrasenia',
        'fechaNacimiento',
        'foto',
        'genero',
        'rol',
    ];

    protected $hidden = [
        'contrasenia',
    ];

    public function getAuthPassword()
    {
        // Laravel espera que el atributo de contraseña sea "password". Mapéalo correctamente.
        return $this->contrasenia;
    }
}
