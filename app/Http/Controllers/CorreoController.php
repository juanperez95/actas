<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    public function enviarCorreo(Request $request)
    {
        // Aquí puedes manejar la lógica para enviar el correo.
        // Puedes acceder a los datos del request, validarlos, etc.
        
        // Ejemplo de lógica para enviar el correo
        Mail::raw('Contenido del correo', function($message) {
            $message->to('destinatario@correo.com')
                    ->subject('Asunto del correo');
        });

        return response()->json(['message' => 'Correo enviado con éxito']);
    }
}

