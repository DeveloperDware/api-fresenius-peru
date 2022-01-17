<?php

namespace App\Http\Resources;

use App\Http\Resources\Documento;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaDoc extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       
        return [
            "Type"=>$this->cdp_nombre,
            "Documents"=> Documento::collection($this->documentos->where("dp_estado","Activo")->where("dp_paciente",$request->get("Id")))
        ];
    }
}
