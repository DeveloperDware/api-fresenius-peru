<?php

namespace App\Http\Controllers\Api;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PacienteDetalle;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    public function pacienteById(Request $request){
        $validator = Validator::make($request->all(), [
            'Id' => 'required|exists:paciente_hc,id',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors(), 400);
        }
        $paciente = Paciente::find($request->Id);
        return response()->json(new PacienteDetalle($paciente));

    }

    public function pacientes(Request $request){
        $page = $request->get("Page") > 0 ? $request->get("Page"):1;
        $size = $request->get("size") > 0 ? $request->get("size")  : 50 ;
        $orderBy = $request->get("orderBy");
        $direction = $request->get("direction");

        $pacientes = Paciente::select("paciente_hc.*")->leftJoin('sede_hc', "paciente_hc.sede_paciente","=","sede_hc.id_sede")
        ->leftJoin("usuarios", "paciente_hc.id_nutricionista","=","usuarios.n_identificacion")->where(function($sql) use($request){
            if($request->get("Name") != ""){
                $sql->whereRaw("(paciente_hc.nombres like '%".$request->get("Name")."%'  or paciente_hc.apellidos like '%".$request->get("Name")."%' or concat(paciente_hc.nombres,' ',paciente_hc.apellidos)  like '%".$request->get("Name")."%' ) ");
            }
        });
        $camposOrder = [

            "ID" => "paciente_hc.id", 
            "NAME" =>"paciente_hc.apellidos", 
            "CLINICNAME" =>"sede_hc.nombre_sede", 
            "EMAIL" =>"paciente_hc.email", 
            "PHONE" => "paciente_hc.telefono1", 
            "NUTRITIONIST" =>"usuarios.nombres"
        ];
        if(key_exists($orderBy,$camposOrder)){
            $pacientes = $pacientes->orderBy($camposOrder[$orderBy],($direction ? $direction : "ASC" ));
        }
        $pacientes = $pacientes->paginate($size,$page);
        $paginate = $pacientes->toArray();
        $response = [
            "Page" => $page,
            "PageSize" => $size,
            "TotalElements" => $paginate["total"],
            "TotalPages" => $paginate["last_page"],
            "OrderBy" =>  $orderBy,
            "Direction" => $direction,
            "Name" => $request->get("Name"),
            "Results" => PacienteDetalle::collection($pacientes),
        ];
        return response()->json($response);
    }
}
