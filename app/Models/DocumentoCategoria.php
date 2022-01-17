<?php

namespace App\Models;

use App\Models\DocumentoPaciente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentoCategoria extends Model
{
    use HasFactory;
    protected  $table = "cat_docs_pacientes";
    protected  $fillable = [
        "cdp_id",
        "cdp_nombre",
        "cdp_descripcion",
        "cdp_estado",
        "cdp_freg",
        "cdp_ureg",
        "cdp_fmod",
        "cdp_umod",
    ];

    public function documentos(){
        return $this->hasMany(DocumentoPaciente::class,"dp_categoria","cdp_id");
    }
}
