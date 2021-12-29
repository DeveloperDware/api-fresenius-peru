<?php

namespace App\Http\Controllers\Api;

use App\Models\Historia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriaPaciente;
use App\Http\Resources\HistoriasPaciente;
use Illuminate\Support\Facades\Validator;

class HistoriaController extends Controller
{
    public function historias(Request $request){
        $validator = Validator::make($request->all(), [
            'Id' => 'required|exists:paciente_hc,id',
            "type"=>"required"
        ]);

        if($validator->fails()){
                return response()->json($validator->errors(), 400);
        }
        // from paciente_hc left join historia on (paciente_hc.id=historia.id_paciente and historia.hc_estado='Cerrado') order by historia.fecha_historia DESC limit 0,6
        $historias = Historia::select("historia.*")->leftJoin("paciente_hc",function($join){
            $join->on("paciente_hc.id","=","historia.id_paciente")->on("historia.hc_estado","=",\DB::raw("'Cerrado'"));
        })
        ->where("paciente_hc.id",$request->Id)
        ->orderBy("historia.fecha_historia","DESC")->limit("6")->get();
    
        $historiaPaciente =  HistoriasPaciente::collection($historias);
        return response()->json([
            "Id" => $request->Id,
            "Type" => $request->type,
            "records" => $historiaPaciente
        ]);
    }
    public function historia(Request $request){
        $validator = Validator::make($request->all(), [
            'Id' => 'required|exists:paciente_hc,id',
            "type"=>"required"
        ]);

        if($validator->fails()){
                return response()->json($validator->errors(), 400);
        }
        // from paciente_hc left join historia on (paciente_hc.id=historia.id_paciente and historia.hc_estado='Cerrado') order by historia.fecha_historia DESC limit 0,6
        $historia = Historia::select("historia.*")->leftJoin("paciente_hc",function($join){
            $join->on("paciente_hc.id","=","historia.id_paciente")->on("historia.hc_estado","=",\DB::raw("'Cerrado'"));
        })
        ->where("paciente_hc.id",$request->Id)
        ->orderBy("historia.fecha_historia","DESC")
        ->limit("1")->first();
    
        
        return response()->json(new HistoriaPaciente($historia));
    }
}
