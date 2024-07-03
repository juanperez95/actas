<?php

namespace App\Http\Controllers;

use App\Models\CampanasActas as ModelsCampanasActas;
use Illuminate\Http\Request;

class CampanasActas extends Controller
{

    // Agregar campañas
    public function AgregarCam(Request $request){
        return null;
    }
    // Modificar
    public function ModificarCam(Request $request){
        return null;
    }
    // Eliminar
    public function EliminarCam(Request $request){
        return null;
    }

    // Mostrar a todas las campañas de la base de datos
    public function MostrarCam(){
        $camps = ModelsCampanasActas::all();
        // Devolver la respuesta en formato JSON
        return response()->json($camps);
    }
}
