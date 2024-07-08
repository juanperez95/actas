<?php

namespace App\Http\Controllers;

use App\Models\DevolucionEquipo;
use Illuminate\Http\Request;
use PDF;

class DevolucionEquipoController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:150',
            'proyecto_id' => 'required|exists:proyectos,id',
            'diadema' => 'required|boolean',
            'camara' => 'required|boolean',
            'raton' => 'required|boolean',
            'teclado' => 'required|boolean',
            'pantallas' => 'required|integer|min:1',
            'dispositivo_tipo' => 'required|in:torre,mini,portatil',
            'correo_personal' => 'required|email',
            'correo_jefe' => 'required|email'
        ]);


        $devolucion = DevolucionEquipo::create($validatedData);

        return response()->json($devolucion, 201);
    }

    public function generarPDF(DevolucionEquipo $devolucion)
    {
        $pdf = PDF::loadView('pdf.devolucion-equipo', compact('devolucion'));
        return $pdf->download('devolucion-equipo.pdf');
    }
}