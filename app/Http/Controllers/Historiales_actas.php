<?php

namespace App\Http\Controllers;

use App\Models\Historial_pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Historiales_actas extends Controller
{
    // Acceder a las ultimas 4 actas generadas por el gestor seleccionado
    public function AccederDatos($id){
        return Historial_pdf::where('fk_id_gestor',$id)->orderBy('id','desc')->take(4)->get();
    }

    // Opcion que permite volver a descargar
    public function DownloadAgainPDF(Request $request){
        $dompdf = new Dompdf();
        $html = file_get_contents(public_path($request->input('ruta')));
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->stream('try.pdf');
    }
}
