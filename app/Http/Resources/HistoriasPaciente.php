<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoriasPaciente extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $types = [
            "IMC" =>  "imc", 
            "HEIGHT" =>   "talla", 
            "WEIGHT" =>  "peso_ac", 
            "BLOOD_PREASURE" =>  "ta_ps", 
            "BLOOD_PREASURE_LOW" => "ta_pd",
            "GLUCOSE" =>  "glic", 
            "CREATININE" => "crs", 
            "UREA" => "v_urea", 
            "PHOSPHORUS" =>  "p", 
            "POTASSIUM" =>  "k"
        ];
        $llave = "imc";
        $type = request()->get("type");
        if(key_exists($type,$types)){
            
            $llave = strtolower($types[$type]);
        }
        return [
            "Id" => $this->paciente->id,
            "EventDate" => $this->fecha_historia,
            "Description" => request()->get("type"),
            "UnitMeasurement" => $this[$llave."_unidad"],
            "Value" =>  $this[$llave],
            "Minimun" => $this[$llave."_min"],
            "Maximun" => $this[$llave."_max"]
        ];
    }
}
