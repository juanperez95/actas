<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Pdf extends Controller
{
    // Vista principal de los formularios
    public function index(){
        return view("actas");
    }

    // Generar PDF de la operacion
    public function pdfOperacion(Request $request){
        // Datos basicos
        $nombre_encargado = strtoupper($request->input('nombre_encargado'));
        $documento_encargado = $request->input('documento_encargado');
        $correo_encargado = $request->input('correo_encargado');
        // N° Caso
        $n_caso = $request->input('n_caso');
        // Motivos
        $motivo_solicitud = $request->input('motivo_solicitud');
        $op_solicitante = $request->input('op_solicitante');
        $est_entrega_nuevoActivo = $request->input('est_entrega_nuevoActivo');
        $est_recibido_activo = $request->input('est_recibido_activo');
        // Fecha
        $fecha_entrega = $request->input('fecha_entrega');
        // Datos equipos recogidos
        $data_recogido = $request->input('data_recogido');
        // Datos equipos entregados
        $data_entregado = $request->input('data_entregado');
        // Observaciones
        $observaciones = $request->input('observaciones');
        // Firmas
        $nombre_gestor = strtoupper($request->input('nombre_gestor'));
        $cargo_operacion = strtoupper($request->input('cargo_operacion'));
        $nombre_operacion = strtoupper($request->input('nombre_operacion'));


        $pdf = App::make('dompdf.wrapper');
        // Compactar todas la variables para enviarlas al PDF
        $pdf->loadView('pdf_operacion',compact('nombre_encargado',
        'documento_encargado',
        'correo_encargado',
        'n_caso',
        'motivo_solicitud',
        'op_solicitante',
        'est_entrega_nuevoActivo',
        'est_recibido_activo',
        'fecha_entrega',
        'data_recogido',
        'data_entregado',
        'observaciones',
        'nombre_gestor',
        'cargo_operacion',
        'nombre_operacion'));
        
        return $pdf->download('prueba.pdf');
    }


    // Generar PDF del gestor
    public function pdfGestor(Request $request){
        // Datos basicos
        $nombre_persona = $request->input('nombre_persona');
        $documento_persona = $request->input('documento_persona');
        $correo_persona = $request->input('correo_persona');
        // Nombre gestor
        $nombre_gestor = $request->input('nombre_gestor');
        // Motivos
        $motivo_solicitud = $request->input('motivo_solicitud');
        $op_solicitante = $request->input('op_solicitante');
        $fecha_entregaActivo = $request->input('fecha_entregaActivo');
        // Datos de elementos y observaciones
        $ingreso_elemento = $request->input('ingreso_elemento');
        $serial_elemento = $request->input('serial_elemento');
        $activo_elemento = $request->input('activo_elemento');
        $observaciones_elemento = $request->input('observaciones_elemento');
        $observaciones = $request->input('observaciones');
        // Nombre de quien entrega e elemento
        $nombre_deEntrega = $request->input('nombre_deEntrega');
        // Datos de elemento
        $data_elemento = $request->input('data_elemento');

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf_gestor',compact(
            'nombre_persona',
            'documento_persona',
            'correo_persona',
            'nombre_gestor',
            'motivo_solicitud',
            'op_solicitante',
            'fecha_entregaActivo',
            'ingreso_elemento',
            'serial_elemento',
            'activo_elemento',
            'observaciones_elemento',
            'observaciones',
            'nombre_deEntrega',
            'data_elemento',
        ));
        return $pdf->download('gestor.pdf');
    }


}
