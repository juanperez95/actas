<?php

use App\Http\Controllers\CampanasActas;
use App\Http\Controllers\ComponentesController;
use App\Http\Controllers\DevolucionEquipoController;
use App\Http\Controllers\GestoresActas;
use App\Http\Controllers\Historiales_actas;
use App\Http\Controllers\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', [Pdf::class,'index']);
Route::get('/Actas',[Pdf::class,'Home'])->name('home');
Route::post('/PDF_OP',[Pdf::class,'pdfOperacion'])->name('pdf_operacion');
Route::post('/PDF_G',[Pdf::class,'pdfGestor'])->name('pdf_gestor');
Route::post('/PDF_RTN',[Pdf::class,'pdfRetorno'])->name('pdf_retorno');

// Acciones con los gestores de la base de datos
Route::get('/Actas_de_responsabilidad/Gestores',[GestoresActas::class,'MostrarGestores'])->name('mostrar_gestor');
Route::get('/Actas_de_responsabilidad/Gestores/Admin',[GestoresActas::class,'MostrarTodos'])->name('mostrar_gestor');
Route::post('/Actas_de_responsabilidad/Gestores/Registro',[GestoresActas::class,'AgregarGestores'])->name('registro_gestor');
Route::post('/Actas_de_responsabilidad/Gestores/BuscarGestor',[GestoresActas::class,'BuscarGestor'])->name('buscar_gestor');
Route::post('/Actas_de_responsabilidad/Gestores/BuscarGestorName',[GestoresActas::class,'BuscarGestorName'])->name('buscar_gestor_nombre');
Route::delete('/Actas_de_responsabilidad/Gestores/Destroy/{id}',[GestoresActas::class,'EliminarGestores'])->name('borrar_gestor');
Route::put('/Actas_de_responsabilidad/Gestores/Update/{id}',[GestoresActas::class,'ModificarGestores'])->name('editar_gestor');
Route::get('/Actas_de_responsabilidad/Gestores/Session',[GestoresActas::class,'getSessionGestor'])->name('inicio_gestor');
Route::post('/Actas_de_responsabilidad/Gestores/ResetPass/{id}',[GestoresActas::class,'ResetPassGestor'])->name('restablecer_gestor');
Route::get('/Actas_de_responsabilidad/Gestores/Filtro/{fk_gestor}',[Historiales_actas::class,'BuscarHistorialGestor'])->name('historial_gestor');


// Acciones con las campañas
Route::get('/Actas_de_responsabilidad/Campanas',[CampanasActas::class,'MostrarCam'])->name('mostrar_cam');
Route::post('/Actas_de_responsabilidad/Campanas/Registro',[CampanasActas::class,'AgregarCam'])->name('agregar_cam');
Route::post('/Actas_de_responsabilidad/Campanas/BuscarCamp',[CampanasActas::class,'BuscarCamp'])->name('buscar_cam');
Route::delete('/Actas_de_responsabilidad/Campanas/Destroy/{id}',[CampanasActas::class,'EliminarCam'])->name('borrar_cam');
Route::put('/Actas_de_responsabilidad/Campanas/Update/{id}',[CampanasActas::class,'ModificarCam'])->name('editar_cam');
Route::get('/Actas_de_responsabilidad/Campanas/Filtro/{fk_cam}',[Historiales_actas::class,'BuscarHistorialCamp'])->name('historial_cam');
    
// Registro de campañas y registros
Route::get('/Actas_de_responsabilidad/Registro/Camps_y_gestores',[Pdf::class,'registroCamGestor'])->name('registro_camps_gestor');


// Acciones con componentes en la base de datos
Route::post('/Actas_de_responsabilidad/Componentes/Agregar_com',[ComponentesController::class,'AgregarComponente'])->name('agregar_componentes');
Route::get('/Actas_de_responsabilidad/Componentes',[ComponentesController::class,'MostrarComponente'])->name('mostrar_componentes');
Route::post('/Actas_de_responsabilidad/Componentes/Buscar_com/{id}',[ComponentesController::class,'BuscarComponente'])->name('buscar_componentes');
Route::put('/Actas_de_responsabilidad/Componentes/Update/{id}',[ComponentesController::class,'ModificarComponente'])->name('editar_componentes');
Route::delete('/Actas_de_responsabilidad/Componentes/Destroy/{id}',[ComponentesController::class,'BorrarComponente'])->name('borrar_componentes');

// Acta de retornos
Route::get('/devolucion-equipo', function () {
    return view('devolucion-equipo');
});

Route::post('/api/devolucion-equipo', [DevolucionEquipoController::class, 'store']);

// Rutas de login
Route::get('/Actas_de_responsabilidad/Login',[Pdf::class,'Login'])->name('inicio_sesion');
Route::post('/Actas_de_responsabilidad/Login/Validate',[Pdf::class,'InicioSesionValidate'])->name('validar_inicio_sesion');
Route::get('/Actas_de_responsabilidad/Login/Destroy',[Pdf::class,'SignOut'])->name('cerrar_sesion');
Route::get('/Actas_de_responsabilidad/Login/DestroyAuto',[Pdf::class,'SignOutAuto'])->name('cerrar_sesion_auto');

// Rutas de historial
Route::post('/Actas_de_responsabilidad/Historial/{id}',[Historiales_actas::class,'AccederDatos'])->name('historial_actas');
Route::post('/Actas_de_responsabilidad/Historial/DownloadPDF/{id}',[Historiales_actas::class,'DownloadAgainPDF'])->name('download_actas');
Route::post('/Actas_de_responsabilidad/Historial/BuscarCaso/{id}',[Historiales_actas::class,'BuscarHistorialBasic'])->name('buscar_actas');
Route::post('/Actas_de_responsabilidad/Historial/BuscarCasoAvanzado/{f_inicio}/{f_fin}',[Historiales_actas::class,'BuscarHistorialHard'])->name('buscar_actas');