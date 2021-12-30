<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NutricionistaLista extends JsonResource
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
            "Id" => $this->n_identificacion,
            "FullName" => $this->nombres,
            "ClinicId" => $this->sede,
            "ClinicName" => $this->sedeInfo ? $this->sedeInfo->nombre_sede : "",
            "Phone" => $this->telefono,
            "Email" => $this->correo,
        ];
    }
}
