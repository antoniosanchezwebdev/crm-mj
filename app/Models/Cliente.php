<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "clientes";

    protected $fillable = [
        "genero",
        "nombre",
        "apellido",
        "direccion_tipo_calle",
        "direccion_calle",
        "direccion_num_calle",
        "direccion_adicional_1",
        "direccion_adicional_2",
        "direccion_adicional_3",
        "direccion_codigo_postal",
        "direccion_ciudad",
        "dni",
        "telefono_1",
        "telefono_2",
        "telefono_3",
        "email_1",
        "email_2",
        "email_3",
        "comunicacion_postal",
        "comunicacion_email",
        "comunicacion_sms",
    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
