<?php

namespace App\Models;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function sedeInfo(){
        return $this->hasOne(Sede::class, "id_sede",'sede');

    }
    public function pacientes(){
        return $this->hasMany(Paciente::class, "id_nutricionista",'n_identificacion');

    }
}
