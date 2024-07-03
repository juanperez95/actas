<?php

namespace App\Http\Controllers;

use App\Models\GestoreActas;
use Illuminate\Http\Request;

class GestoresActas extends Controller
{
    // Agregar gestores
    public function AgregarGestores(Request $request){
        return null;
    }
    // Modificar
    public function ModificarGestores(Request $request){
        return null;
    }
    // Eliminar
    public function EliminarGestores(Request $request){
        return null;
    }

    // Mostrar a todos los gestores de la base de datos
    public function MostrarGestores(){
        $gestores = GestoreActas::all();
        // Devolver la respuesta en formato JSON
        return response()->json($gestores);
    }
}
