<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PacienteDetalle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $apellidos =  explode(" ",$this->apellidos);
        return [
            "Id" => $this->id,
            "FullName" => $this->nombres. " " . $this->apellidos ,
            "Name" => $this->nombres ,
            "LastName" => $apellidos[0],
            "MaidenName" => (isset($apellidos[1]) ? $apellidos[1] :" ") . (isset($apellidos[2]) ? " ".$apellidos[2] :" "),
            "ClinicId" => $this->sede ? $this->sede->id_sede:"",
            "ClinicName" => $this->sede ? $this->sede->nombre_sede : "",
            "Phone" => $this->telefono1,
            "Email" => $this->email,
            "NutritionistId" => $this->id_nutricionista,
            "Nutritionist" => $this->nutricionista ? $this->nutricionista->nombres :""
        ];
    }
}
