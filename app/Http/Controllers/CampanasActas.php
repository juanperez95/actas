<?php

namespace App\Http\Controllers;

use App\Models\CampanasActas as ModelsCampanasActas;
use Illuminate\Http\Request;

class CampanasActas extends Controller
{

    // Agregar campañas
    public function AgregarCam(Request $request){
        $cam = ModelsCampanasActas::where('nombre_camp',$request->input('nombre_cam'))->exists();
        if($cam){
            return true;
        }

        $camp = new ModelsCampanasActas();
        $camp->nombre_camp = $request->input('nombre_cam');
        $camp->save();
        return false;
    }
    // Modificar
    public function ModificarCam($id, Request $request){
        $cam = ModelsCampanasActas::where('nombre_camp',$id)->first();
        $cam->nombre_camp = $request->input('nombre_camp');
        $cam->save();
    }
    // Eliminar
    public function EliminarCam($id){
        $cam = ModelsCampanasActas::find($id);
        $cam->delete();
    }

    // Mostrar a todas las campañas de la base de datos
    public function MostrarCam(){
        $camps = ModelsCampanasActas::all();
        // Devolver la respuesta en formato JSON
        return response()->json($camps);
    }

    // Buscar campaña
    public function BuscarCamp(Request $request){
        $cam = ModelsCampanasActas::where('nombre_camp',$request->input('id'))->first();
        return response()->json($cam);
    }

}
