<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Evento extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cn_finicio = new Carbon($this->cn_finicio);
        $cn_ffin = new Carbon($this->cn_ffin);
        return [
            "CodeFile"=>$this->cn_paciente,
            "FullName"=>$this->paciente->nombres." ".$this->paciente->apellidos,
            "Start"=>$cn_finicio->format("c"),
            "End"=>$cn_ffin->format("c"),
        ];
    }
}
