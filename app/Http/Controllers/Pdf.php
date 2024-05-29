<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
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
        ini_set('max_execution_time', 120); 
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

        // Recoger las firmas 
        $firma1 = $request->input('firma1');
        $firma2 = $request->input('firma2');

        // Decodificar las dos firmas
        $data = $this->encodeImagen($firma1, $firma2);

        $ruta1 = $data['ruta1'];
        $ruta2 = $data['ruta2'];
        $rutaLogo = $data['rutaLogo'];

        $opciones = new Options();
        $opciones->set('isRemoteEnabled', true);


        try{
            $pdf = new Dompdf($opciones);
            // Compactar todas la variables para enviarlas al PDF
            $vista = view('pdf_operacion',compact('nombre_encargado',
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
            'nombre_operacion',
            'ruta1',
            'ruta2',
            'rutaLogo'));
    
            $pdf->loadHtml($vista);
            $pdf->render();

        }catch(Exception $e){
            error_log($e->getMessage());
        }

        
        return $pdf->stream('prueba.pdf');
    }


    // Generar PDF del gestor
    public function pdfGestor(Request $request){
        // Datos basicos
        $nombre_persona = strtoupper($request->input('nombre_persona'));
        $documento_persona = $request->input('documento_persona');
        $correo_persona = $request->input('correo_persona');
        // Nombre gestor
        $nombre_gestor = strtoupper($request->input('nombre_gestor'));
        // Motivos
        $motivo_solicitud = $request->input('motivo_solicitud');
        $op_solicitante = $request->input('op_solicitante');
        $fecha_entregaActivo = $request->input('fecha_entregaActivo');
        // Datos de elementos y observaciones
        $ingreso_elemento = strtoupper($request->input('ingreso_elemento'));
        $serial_elemento = strtoupper($request->input('serial_elemento'));
        $activo_elemento = strtoupper($request->input('activo_elemento'));
        $observaciones_elemento = $request->input('observaciones_elemento');
        $observaciones = $request->input('observaciones');
        // Nombre de quien entrega e elemento
        $nombre_deEntrega = $request->input('nombre_deEntrega');
        // Datos de elemento
        $data_elemento = $request->input('data_elemento');

        // Firmas desde vue
        $firma1 = $request->input('firma1');
        $firma2 = $request->input('firma2');

        // Codificar las imagenes
        $data =$this->encodeImagen($firma1,$firma2);
        $rutaLogo = $data['rutaLogo'];
        $ruta1 = $data['ruta1'];
        $ruta2 = $data['ruta2'];

        $opciones = new Options();
        $opciones->set('isRemoteEnabled', true);

        $pdf = new Dompdf($opciones);
        $vista = view('pdf_gestor',compact(
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
            'ruta1',
            'ruta2',
            'rutaLogo'
        ));

        $pdf->loadHtml($vista);
        $pdf->render();

        return $pdf->stream('gestor.pdf');
    }

    // Funcion para codificar imagenes de las firmas y logo de la compañia
    public function encodeImagen($firma1, $firma2){
        $firma1 = str_replace('data:image/png;base64,', '', $firma1);
        $firma2 = str_replace('data:image/png;base64,', '', $firma2);

        $firma1 = str_replace(' ', '+', $firma1);
        $firma2 = str_replace(' ', '+', $firma2);

        $firmaImg1 = base64_decode($firma1);
        $firmaImg2 = base64_decode($firma2);

        // Guardar imagenes en el servidor
        $ruta1 = public_path('firmas\firma1.png');
        $ruta2 = public_path('firmas\firma2.png');
        $rutaLogo = public_path('images\americas.png');

        file_put_contents($ruta1, $firmaImg1);
        file_put_contents($ruta2, $firmaImg2);

        $ruta1 = File::get($ruta1);
        $ruta1 = base64_encode($ruta1);

        $ruta2 = File::get($ruta2);
        $ruta2 = base64_encode($ruta2);

        $rutaLogo = File::get($rutaLogo);
        $rutaLogo = base64_encode($rutaLogo);

        return compact('ruta1', 'ruta2', 'rutaLogo');
    }


}
