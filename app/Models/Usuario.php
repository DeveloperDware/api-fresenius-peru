<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected  $table = "usuarios";
    protected  $fillable = [
        "n_identificacion",
        "tipo_doc",
        "nombres",
        "correo",
        "telefono",
        "estado",
        "menu",
        "usuario",
        "pass",
        "departamento",
        "extension",
        "firma_digital",
        "origen_doc",
        "area",
        "fecha_ingreso",
        "regional",
        "nivel",
        "foto",
        "sede",
        "f_primera",
        
    ];
}
