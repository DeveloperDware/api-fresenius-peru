<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;
    protected  $table = "sede_hc";
    protected  $fillable = [
        "id_sede",
        "nombre_sede",
        "direccion",
        "telefono",
        "estado_sede",
        "cod_sede",

    ];
}
