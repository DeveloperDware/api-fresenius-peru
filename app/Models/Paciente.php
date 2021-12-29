<?php

namespace App\Models;

use App\Models\Sede;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasFactory;

    protected $table = "paciente_hc";
    protected $fillable = [
        "id",
        "tipo_id",
        "nombres",
        "apellidos",
        "direccion",
        "telefono1",
        "telefono2",
        "telefono3",
        "fecha_nac",
        "ocupacion",
        "eps",
        "email",
        "genero",
        "estado_civil",
        "departamento",
        "ciudad",
        "localidad",
        "barrio",
        "nefrologo",
        "programa",
        "tipo_id_acu",
        "id_acu",
        "nombre_acu",
        "apellido_acu",
        "genero_acu",
        "est_civil_acu",
        "direccion_acu",
        "depto_acu",
        "ciudad_acu",
        "localidad_acu",
        "barrio_acu",
        "tel_acu",
        "tel2_acu",
        "tel3_acu",
        "email_acu",
        "parentesco",
        "estado",
        "motivo",
        "foto",
        "sede_paciente",
        "raza",
        "id_nutricionista"        ,
    ];

    public function sede(){
        return $this->hasOne(Sede::class, "id_sede",'sede_paciente');

    }
    public function nutricionista(){
        return $this->hasOne(Usuario::class, "n_identificacion",'id_nutricionista');

    }
}
