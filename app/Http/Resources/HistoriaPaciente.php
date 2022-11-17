<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoriaPaciente extends JsonResource
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
            "ENERGY" =>   "calorias_t" , 
            "PROTEIN" =>   "proteina_tgr", 
            "LIPIDS" =>  "grasa_tgr" , 
            "CARBOHYDRATES" =>  "chos_tgr", 
            "WATER" =>   "liq_dia", 
            "SODIUM" =>   "sal_dia"
			
        ];
        $llave = "ENERGY";
        $llave2 = "ENERGY";
        $type = request()->get("type");
        if(key_exists($type,$types)){
            $llave = $types[$type];
            $llave2 = $type;
        }
        return [
            "Id" => $this->paciente->id,
            "Type" => $llave2,
            "Limit" =>  $this[strtolower($llave)],
        ];
    }
}
