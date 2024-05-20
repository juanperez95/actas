<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pdf extends Controller
{
    // Vista principal de los formularios
    public function index(){
        return view("actas");
    }

    // Generar PDF del gestor
    public function pdfGestor(){
        
    }


}
