<?php

namespace App\Http\Controllers;

use App\Models\Historial_pdf;
use Illuminate\Http\Request;

class Historiales_actas extends Controller
{
    // Acceder a las ultimas 4 actas generadas por el gestor seleccionado
    public function AccederDatos($id){
        return Historial_pdf::where('fk_id_gestor',$id)->orderBy('id','desc')->take(4)->get();
    }

    // Opcion que permite volver a descargar
    public function DownloadAgainPDF($fileName){
        if(file_exists(public_path($fileName))){
            return response()->download(public_path($fileName));
        }
        return abort(404);
    }
}
