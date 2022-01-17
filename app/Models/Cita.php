<?php

namespace App\Models;

use App\Models\Sede;
use App\Models\Usuario;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;
    protected  $table = "citas_nutricionista";
    protected  $fillable = [
        "cn_id",
        "cn_nutricionista",
        "cn_paciente",
        "cn_finicio",
        "cn_ffin",
        "cn_estado",
        "cn_observacion",
        "cn_freg",
        "cn_ureg",
        "cn_fmod",
        "cn_umod",

    ];

    public function nutricionista(){
        return $this->hasOne(Usuario::class, "cn_nutricionista",'n_identificacion');
    }
    public function paciente(){
        return $this->hasOne(Paciente::class, "id","cn_paciente" );
    }
       
}
