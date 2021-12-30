<?php

namespace App\Http\Resources;

use App\Http\Resources\NutricionistaPaciente;
use Illuminate\Http\Resources\Json\JsonResource;

class Nutricionista extends JsonResource
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
            "Patients"=>NutricionistaPaciente::collection($this->pacientes)
        ];
    }
}
