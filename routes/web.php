<?php

use App\Http\Controllers\CampanasActas;
use App\Http\Controllers\GestoresActas;
use App\Http\Controllers\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', [Pdf::class,'index']);
Route::get('/Actas_de_responsabilidad',[Pdf::class,'Home'])->name('home');
Route::post('/PDF_OP',[Pdf::class,'pdfOperacion'])->name('pdf_operacion');
Route::post('/PDF_G',[Pdf::class,'pdfGestor'])->name('pdf_gestor');

// Acciones con los gestores de la base de datos
Route::get('/Actas_de_responsabilidad/Gestores',[GestoresActas::class,'MostrarGestores'])->name('mostrar_gestor');


// Acciones con las campañas
Route::get('/Actas_de_responsabilidad/Campanas',[CampanasActas::class,'MostrarCam'])->name('mostrar_cam');

// Registro de campañas y registros
Route::get('/Actas_de_responsabilidad/Registro/Camps_y_gestores',[Pdf::class,'registroCamGestor'])->name('registro_camps_gestor');
