<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Nutricionista;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\NutricionistaLista;

class NutricionistaController extends Controller
{
    public function nutricionistaById(Request $request){
        $validator = Validator::make($request->all(), [
            'Id' => 'required|exists:usuarios,n_identificacion',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors(), 400);
        }
        // select usuarios.nombres, usuarios.sede, usuarios.telefono, usuarios.correo, 
        // sede_hc.nombre_sede, paciente_hc.id, paciente_hc.nombres, paciente_hc.apellidos 
        // from usuarios left join sede_hc on usuarios.sede=sede_hc.id_sede 
        // left join paciente_hc on paciente_hc.id_nutricionista=usuarios.n_identificacion 
        // where usuarios.n_identificacion={id}
        $usuarios = Usuario::where("n_identificacion",$request->get("Id"))->first();

        return response()->json(new Nutricionista($usuarios));

    }

    public function nutricionistas(Request $request){
        $page = $request->get("Page") > 0 ? $request->get("Page"):1;
        $size = $request->get("size") > 0 ? $request->get("size")  : 50 ;
        $orderBy = $request->get("orderBy");
        $direction = $request->get("direction");

        $usuarios = Usuario::select("usuarios.*")
        ->leftJoin('sede_hc', "usuarios.sede","=","sede_hc.id_sede")
        ->where(function($sql) use($request){
            if($request->get("Name") != ""){
                $sql->whereRaw(" usuarios.nombres like '%".$request->get("Name")."%'   ");
            }
        });

        
        $camposOrder = [
            "ID" => "usuarios.n_identificacion" ,
            "NAME" => "usuarios.nombres", 
            "CLINICNAME" => "sede_hc.nombre_sede", 
            "EMAIL" => "usuarios.correo", 
            "PHONE" => "usuarios.telefono"
        ];
        if(key_exists($orderBy,$camposOrder)){
            $usuarios = $usuarios->orderBy($camposOrder[$orderBy],($direction ? $direction : "ASC" ));
        }
        $usuarios = $usuarios->paginate($size,$page);
        $paginate = $usuarios->toArray();
        $response = [
            "Page" => $page,
            "PageSize" => $size,
            "TotalElements" => $paginate["total"],
            "TotalPages" => $paginate["last_page"],
            "OrderBy" =>  $orderBy,
            "Direction" => $direction,
            "Name" => $request->get("Name"),
            "Results" => NutricionistaLista::collection($usuarios),
        ];
        return response()->json($response);
    }
}
