<?php

namespace App\Http\Controllers;

use App\Models\Historial_pdf;
use Illuminate\Http\Request;

class Historiales_actas extends Controller
{
    //
    public function AccederDatos($id){
        return Historial_pdf::where('fk_id_gestor',$id)->orderBy('id','desc')->take(4)->get();
    }
}
