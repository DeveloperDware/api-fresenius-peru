<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Agenda extends JsonResource
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
            "Id"=> $this->n_identificacion,
            "FullName"=> $this->nombres,
            "ClinicId"=> $this->sedeInfo->id_sede,
            "ClinicName"=>$this->sedeInfo->nombre_sede,
            "Phone"=> $this->telefono,
            "Email"=> $this->correo,
            "Events"=> Evento::collection($this->calendario->where("cn_estado","Agendada")) 
        ];
    }
}
