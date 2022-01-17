<?php

namespace App\Models;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentoPaciente extends Model
{
    use HasFactory;
    protected  $table = "docs_pacientes";
    protected  $fillable = [
        "dp_id",
        "dp_categoria",
        "dp_nombre",
        "dp_paciente",
        "dp_archivo",
        "dp_estado",
        "dp_freg",
        "dp_ureg",
        "dp_fmod",
        "dp_umod",
    ];

    public function paciente(){
        return $this->hasOne(Paciente::class, "id","dp_paciente" );
    }
}
