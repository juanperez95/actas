<?php

namespace App\Http\Controllers;

use App\Models\GestoreActas;
use Illuminate\Http\Request;

class GestoresActas extends Controller
{
    // Agregar gestores
    public function AgregarGestores(Request $request){

        // Validar si ya existe el correo
        $gestor = GestoreActas::where('correo',$request->input('correo'))->exists();
        if($gestor){
            return response()->json(true);
        }else{
            // Instancia de modelo gestor
            $gestor = new GestoreActas();
            $gestor->nombre_gestor = $request->input('nombre');
            $gestor->correo = $request->input('correo');
            $gestor->save();
            return response()->json(false);
        }

    }
    // Modificar
    public function ModificarGestores(Request $request){
        return null;
    }
    // Eliminar
    public function EliminarGestores($id){
        GestoreActas::find($id)->delete();
        return response()->json(true);
    }

    // Mostrar a todos los gestores de la base de datos
    public function MostrarGestores(){
        $gestores = GestoreActas::all();
        // Devolver la respuesta en formato JSON
        return response()->json($gestores);
    }

    // Buscar a un gestor en especifico al filtrarlo en vue
    public function BuscarGestor(Request $request){
        $gestor = GestoreActas::find($request->input('id'));
        return response()->json($gestor);
    }
}
