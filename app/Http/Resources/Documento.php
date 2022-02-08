<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Documento extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dp_freg = new Carbon($this->dp_freg);
        $archivo =explode(".",$this->dp_archivo);
        return [
            "Id" => 	$this->dp_id,
            "Title" => 	$this->dp_archivo,
            "Date" => $dp_freg->format("c"),
            "Url"=> "https://10.223.65.25/HC/admintranet/verArchivoPacientesAPI.php?na=$this->dp_archivo",
            "ContentType"=>"application/".$archivo[count($archivo)-1]
        ];
    }
}
